<?php
namespace app\models;
use yii\web\IdentityInterface;
use Yii;
/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $email
 * @property string $login
 * @property string $password
 * @property integer $type
 * @property integer $is_active
 * @property integer $is_notice
 * @property string $authkey
 * @property string $sessionkey
 * @property string $created_at
 * @property string $updated_at
 *
 * @property UserTypes $type0
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    protected $__salt = '7z0ZzugKmnQW';

    const TYPE_CONSULTANT = 5;
    const TYPE_CONSULTANT_ADMIN = 8;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'is_active', 'is_notice'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'last_name', 'middle_name', 'email', 'login', 'authkey', 'sessionkey'], 'string', 'max' => 60],
            [['password', 'phone'], 'string', 'max' => 20],
            [['type'], 'exist', 'skipOnEmpty' => false, 'targetClass' => UserType::className(), 'targetAttribute' => ['type' => 'id']],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'email' => 'Email',
            'login' => 'Логин',
            'password' => 'Пароль',
            'type' => 'Тип',
            'is_active' => 'Активен?',
            'is_notice' => 'Включить оповещения?',
            'authkey' => 'Authkey',
            'sessionkey' => 'Sessionkey',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'phone' => 'Телефон',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(UserType::className(), ['id' => 'type']);
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public static function findByUsername($username)
    {
        if($user = self::findOne(['login' => $username]))
            return $user;
        return null;
    }

    public function getAuthKey()
    {
        return $this->authkey;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->hashPassword($password) === $this->password;
    }

    public function hashPassword($password)
    {
        return md5($password . $this->__salt);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->authkey = \Yii::$app->security->generateRandomString();
                $this->sessionkey = \Yii::$app->security->generateRandomString();
                $this->created_at = date("Y-m-d H:i:s");
            }
            $this->updated_at = date("Y-m-d H:i:s");
            if(!empty($this->password)){
                $this->password = $this->hashPassword($this->password);
            }else{
                $this->password = $this->oldAttributes['password'];
            }
            return true;
        }
        return false;
    }

    public function getFullName()
    {
        return $this->last_name . " " . $this->first_name;
    }

    public function isConsultant()
    {
        return in_array($this->type, [self::TYPE_CONSULTANT, self::TYPE_CONSULTANT_ADMIN]);
    }

    public function consultantStatistic()
    {
        $statistic = ['count' => 0, 'sum' =>0, 'points' => 0];
        if($this->isConsultant()){
            $statistic['count'] = Yii::$app->db->createCommand("
                SELECT count(id) 
                FROM events_services 
                WHERE id_consultant = :id_consultant AND consultant_end > :d_past AND consultant_end < :d_future
            ")->bindValues([
                ':id_consultant' => $this->id,
                ':d_past' => date('Y-m-d'),
                ':d_future' => (new \DateTime('tomorrow'))->format('Y-m-d'),
            ])->queryScalar();

            $statistic['sum'] = Yii::$app->db->createCommand("
                SELECT sum(s1.value) 
                FROM (
                    SELECT es.id_service, cc.value, es.id_consultant, es.consultant_end
                    FROM events_services es
                    LEFT JOIN consultants_cost cc ON cc.id_service = es.id_service AND cc.id_consultant_type = (
                        SELECT id_type FROM consultants WHERE id_user = :id_user)  
                ) s1
                WHERE s1.id_consultant = :id_user AND s1.consultant_end > :d_past AND s1.consultant_end < :d_future
            ")->bindValues([
                ':id_user' => $this->id,
                ':d_past' => date('Y-m-d'),
                ':d_future' => (new \DateTime('tomorrow'))->format('Y-m-d'),
            ])->queryScalar();

            $statistic['points'] = Yii::$app->db->createCommand("
                SELECT count(distinct id_client) 
                FROM client_recomendations
                WHERE id_consultant = :id_user
                GROUP BY id_client
            ")->bindValues([
                ':id_user' => $this->id,
            ])->queryScalar() + Yii::$app->db->createCommand("
                SELECT count(distinct id_client) 
                FROM client_recomendations
                WHERE id_consultant = :id_user 
                    AND is_visited = 1
                GROUP BY id_client
            ")->bindValues([
                ':id_user' => $this->id,
            ])->queryScalar();
        }
        return $statistic;
    }

    public function getMenu()
    {
        $items = [];
        // var_dump($this->type);die;
        if($this->type == self::TYPE_CONSULTANT){
            $items[] = ['label' => 'Консультант', 'url' => ['/consultant/search']];
        }else{
            if($this->type == self::TYPE_CONSULTANT_ADMIN){
                $items[] = ['label' => 'Консультант', 'url' => ['/consultant/search']];
            }
            $items = array_merge($items, [
                ['label' => 'Начало', 'url' => ['/site/index']],
                ['label' => 'Справочники', 'url' => ['/directory/default/index']],
                // ['label' => 'Отчеты', 'url' => ['/report/index']],
                ['label' => 'Список клиентов', 'url' => ['/client/index']],
                // ['label' => 'Генератор писем', 'url' => ['/emails/']],
                ['label' => 'Календарь услуг', 'url' => ['/calendar/index']],
                // ['label' => 'Бронирование', 'url' => ['/booking/list']],
                ['label' => 'В работе', 'url' => ['/consultant/index']],
            ]);
        }
        return $items;
    }
}