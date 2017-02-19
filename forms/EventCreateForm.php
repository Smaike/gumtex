<?php

namespace app\forms;

use Yii;
use yii\base\Model;
use app\models\Event;
use app\models\Client;
use app\models\EventsService;

/**
 * ContactForm is the model behind the contact form.
 */
class EventCreateForm extends Model
{
    public $id;
    public $first_name;
    public $last_name;
    public $middle_name;
    public $birthday;
    public $fio_mother;
    public $fio_father;
    public $fio_sup;
    public $mobile;
    public $p_mobile;
    public $type;
    public $category;
    public $id_consultant;
    public $comment;
    public $where_know;
    public $date;
    public $name;
    public $services;
    public $age;
    public $price;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['birthday'], 'date', 'format' => 'dd-mm-yyyy'],
            [['type', 'category', 'id_consultant', 'age', 'id'], 'integer'],
            [['comment', 'where_know'], 'string'],
            [['first_name', 'last_name', 'middle_name', 'fio_mother', 'fio_father', 'fio_sup'], 'string', 'max' => 60],
            [['mobile', 'p_mobile'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 255],
            [['price'], 'string', 'max' => 11],
            ['date', 'date', 'format' => 'yyyy-mm-dd H:i'],
            ['services', 'each', 'rule' => 'integer'],
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
            'fio_mother' => 'ФИО матери',
            'fio_father' => 'ФИО отца',
            'fio_sup' => 'ФИО сопровождающего',
            'mobile' => 'Мобильный телефон',
            'p_mobile' => 'Мобильный телефон родителя',
            'type' => 'Тип',
            'category' => 'Категория',
            'id_consultant' => 'Консультант',
            'comment' => 'Комментарии',
            'where_know' => 'Откуда узнал',
            'name' => "Название события",
            'services' => "Услуги",
            'age' => "Возраст"
        ];
    }

    public function save()
    {
        $client = new Client();
        $event = new Event();
        $event->attributes = $this->attributes;
        $event->status = 1;
        $client->attributes = $this->attributes;
        if(!empty($client->birthday)){
            $date = strtotime($client->birthday);
            $client->birthday = date('Y-m-d', $date);
        }
        if($client->save()){
            $event->id_client = $client->id;
            if($event->save() && !empty($this->services)){
                foreach ($this->services as $service) {
                    $eventService = new EventsService();
                    $eventService->id_event = $event->id;
                    $eventService->id_service = $service;
                    $eventService->status = 'new';
                    $eventService->save();
                }
            }
            return true;
        }
        return false;
    }

    public function update()
    {
        $event = Event::findOne($this->id);
        $client = $event->client;
        $event->attributes = $this->attributes;
        $client->attributes = $this->attributes;
        if(!empty($client->birthday)){
            $date = strtotime($client->birthday);
            $client->birthday = date('Y-m-d', $date);
        }
        if($client->save()){
            EventsService::deleteAll(['id_event' => $this->id]);
            if($event->save() && !empty($this->services)){
                foreach ($this->services as $service) {
                    $eventService = new EventsService();
                    $eventService->id_event = $event->id;
                    $eventService->id_service = $service;
                    $eventService->status = 'new';
                    $eventService->save();
                }
            }
            return true;
        }
        return false;
    }

}
