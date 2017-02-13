<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $birthday
 * @property string $p_first_name
 * @property string $p_last_name
 * @property string $p_middle_name
 * @property string $mobile
 * @property string $p_mobile
 * @property integer $type
 * @property integer $category
 * @property integer $id_consultant
 * @property string $comment
 * @property string $where_know
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['birthday'], 'safe'],
            [['type', 'category', 'id_consultant', 'age'], 'integer'],
            [['comment', 'where_know'], 'string'],
            [['first_name', 'last_name', 'middle_name', 'p_first_name', 'p_last_name', 'p_middle_name'], 'string', 'max' => 60],
            [['mobile', 'p_mobile'], 'string', 'max' => 20],
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
            'birthday' => 'День рождения',
            'p_first_name' => 'Имя родителя',
            'p_last_name' => 'Фамилия родителя',
            'p_middle_name' => 'Отчество родителя',
            'mobile' => 'Телефон',
            'p_mobile' => 'Телефон родителя',
            'type' => 'Тип',
            'category' => 'Категория',
            'id_consultant' => 'Консультант',
            'comment' => 'Комментарии',
            'where_know' => 'Откуда узнал',
            'age' => 'Возраст',
        ];
    }

    public function getClientType()
    {
        return $this->hasOne(ClientType::className(), ['id' => 'type']);
    }
    public function getClientCategory()
    {
        return $this->hasOne(ClientCategory::className(), ['id' => 'category']);
    }
    public function getConsultant()
    {
        return $this->hasOne(User::className(), ['id' => 'id_consultant']);
    }

    public function getFullName()
    {
        return $this->last_name . " " . $this->first_name;
    }
}
