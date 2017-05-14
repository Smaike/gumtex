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
    public $discount;
    public $why;
    public $copy_id;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['birthday'], 'date', 'format' => 'dd-mm-yyyy'],
            [['type', 'category', 'id_consultant', 'age', 'id', 'copy_id', 'discount'], 'integer'],
            [['comment', 'where_know', 'why'], 'string'],
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

    public function load($data, $formName = NULL)
    {
        if(parent::load($data, $formName)){
            $this->services = Yii::$app->request->post('services');
            return true;
        }
    }

    public function save()
    {
        if(empty($this->copy_id)){
            $client = new Client();
            $client->attributes = $this->attributes;
        }else{
            $client = Client::findOne($this->copy_id);
        }
        $event = new Event();
        $event->attributes = $this->attributes;
        $event->status = 1;
        if(!empty($client->birthday)){
            $date = strtotime($client->birthday);
            $client->birthday = date('Y-m-d', $date);
        }
        if($client->save()){
            $event->id_client = $client->id;
            $event->created_by = (Yii::$app->user->id)?Yii::$app->user->id:0;
            if($event->save() && !empty($this->services)){
                $this->event = $event;
                foreach ($this->services as $service) {
                    $eventService = new EventsService();
                    $eventService->id_event = $event->id;
                    $eventService->id_service = $service;
                    $eventService->status = 'new';
                    $eventService->session = \Yii::$app->security->generateRandomString();
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
