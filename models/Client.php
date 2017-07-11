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
/**
 *
 * Значения статусов:
 * 0 - удален
 * 1 - активен
 * 2 - переносится
 *
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
            [['type', 'category', 'age'], 'integer'],
            [['comment', 'where_know'], 'string'],
            [['first_name', 'last_name', 'middle_name', 'fio_mother', 'fio_father', 'fio_sup'], 'string', 'max' => 60],
            [['mobile', 'p_mobile', 'gender'], 'string', 'max' => 20],
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
            'mobile' => 'Телефон клиента',
            'p_mobile' => 'Телефон родителя',
            's_mobile' => 'Телефон сопровождающего',
            'type' => 'Тип',
            'category' => 'Категория',
            'id_consultant' => 'Консультант',
            'comment' => 'Комментарии',
            'where_know' => 'Откуда узнал',
            'age' => 'Возраст',
            'fio_mother' => 'ФИО матери',
            'fio_father' => 'ФИО отца',
            'fio_sup' => 'ФИО сопровождающего',
            'gender' => 'Пол'
        ];
    }

    public function getClientType()
    {
        return $this->hasOne(ClientType::className(), ['id' => 'type']);
    }

    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id_client' => 'id']);
    }

    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['id_client' => 'id']);
    }

    public function getLastEvent()
    {
        return Event::find()->where(['id_client' => $this->id])->orderBy('id desc')->one();
    }

    public function getClientCategory()
    {
        return $this->hasOne(ClientCategory::className(), ['id' => 'category']);
    }

    public function getFullName()
    {
        return $this->last_name . " " . $this->first_name;
    }

    public function getFio()
    {
        return $this->last_name . " " . $this->first_name . " " . $this->middle_name;
    }

    public function getDataForCopiesField()
    {
        $data = $this->fullName . " " . "<a href='#' data-id='" . $this->id . "' class='btn btn-info show_copy'>Просмотреть</a>";
        return $data;
    }

}
