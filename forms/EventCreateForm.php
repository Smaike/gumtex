<?php

namespace app\forms;

use Yii;
use yii\base\Model;
use app\models\Event;
use app\models\Client;

/**
 * ContactForm is the model behind the contact form.
 */
class EventCreateForm extends Model
{
    public $first_name;
    public $last_name;
    public $middle_name;
    public $birthday;
    public $p_first_name;
    public $p_last_name;
    public $p_middle_name;
    public $mobile;
    public $p_mobile;
    public $type;
    public $category;
    public $id_consultant;
    public $comment;
    public $where_know;
    public $date;
    public $name;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['birthday'], 'safe'],
            [['type', 'category', 'id_consultant'], 'integer'],
            [['comment', 'where_know'], 'string'],
            [['first_name', 'last_name', 'middle_name', 'p_first_name', 'p_last_name', 'p_middle_name'], 'string', 'max' => 60],
            [['mobile', 'p_mobile'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 255],
            ['date', 'date', 'format' => 'yyyy-mm-dd H:i']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'first_name' => 'Имя тестируемого',
            'last_name' => 'Фамилия тестируемого',
            'middle_name' => 'Отчество тестируемого',
            'birthday' => 'День рождения',
            'p_first_name' => 'Имя родителя',
            'p_last_name' => 'Фамилия родителя',
            'p_middle_name' => 'Отчество родителя',
            'mobile' => 'Мобильный телефон',
            'p_mobile' => 'Мобильный телефон родителя',
            'type' => 'Тип',
            'category' => 'Категория',
            'id_consultant' => 'Консультант',
            'comment' => 'Комментарии',
            'where_know' => 'Откуда узнал',
            'name' => "Название события"
        ];
    }

    public function save()
    {
        $client = new Client();
        $event = new Event();
        $client->attributes = $this->attributes;
        $event->attributes = $this->attributes;
        if($client->save()){
            $event->id_client = $client->id;
            $event->save();
            return true;
        }
        return false;
    }

}
