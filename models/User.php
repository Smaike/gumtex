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

    const STATUS_DELETED = 0;
    const STATUS_NOT_ACTIVE = 1;
    const STATUS_ACTIVE = 10;

    protected $__salt = '7z0ZzugKmnQW';

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
            [['first_name', 'last_name', 'middle_name', 'email', 'login', 'authkey', 'sessionkey', 'secret_key'], 'string', 'max' => 60],
            [['password'], 'string', 'max' => 60],
            ['secret_key', 'unique']
            //[['type'], 'exist', 'skipOnEmpty' => false, 'targetClass' => UserType::className(), 'targetAttribute' => ['type' => 'id']],
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
            'middle_name' => 'отчество',
            'email' => 'Email',
            'login' => 'Логин',
            'password' => 'Пароль',
            'type' => 'Тип',
            'is_active' => 'Активен?',
            'is_notice' => 'Включить оповещения?',
            'authkey' => 'Authkey',
            'secret_key' => 'Secretkey',
            'sessionkey' => 'Sessionkey',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
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

   /* public function validatePassword($password)
    {
        return $this->hashPassword($password) === $this->password;
    }*/

    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password,$this->password_hash);
    }


    public function hashPassword($password)
    {
        return md5($password . $this->__salt);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->password = $this->hashPassword($this->password);
                $this->authkey = \Yii::$app->security->generateRandomString();
                $this->sessionkey = \Yii::$app->security->generateRandomString();
                $this->created_at = date("Y-m-d H:i:s");
            }
            $this->updated_at = date("Y-m-d H:i:s");
            return true;
        }
        return false;
    }

    public function getFullName()
    {
        return $this->last_name . " " . $this->first_name;
    }

    public function setPassword ($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->authkey = Yii::$app->security->generateRandomString();
    }

    public function generateSecretKey()
    {
        $this->secret_key = Yii::$app->security->generateRandomString().'_'.time();
    }

    public static function findBySecretKey($key)
    {
        if (!static::isSecretKeyExpire($key))
        {
            return null;
        }
        return static::findOne([
            'secret_key' => $key,
        ]);
    }

    public static function isSecretKeyExpire($key)
    {
        if (empty($key))
        {
            return false;
        }
        $expire =  60 * 60;
        $parts = explode('_', $key);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    public function removeSecretKey()
    {
        $this->secret_key = null;
    }
}
