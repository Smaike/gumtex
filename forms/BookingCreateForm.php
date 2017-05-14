<?php

namespace app\forms;

use Yii;
use yii\base\Model;
use app\models\Booking;

/**
 * ContactForm is the model behind the contact form.
 */
class BookingCreateForm extends Model
{
    public $date_start;
    public $date_end;
    public $room_id;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['room_id'], 'integer'],
            [['date_start', 'date_end'], 'date', 'format' => 'yyyy-mm-dd H:i'],
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
            'name' => "Название события",
            'services' => "Услуги",
        ];
    }

    public function save()
    {
        $booking = new Booking();
        $event = new Event();
        $booking->attributes = $this->attributes;
        if($booking->save()){
            return true;
        }
        return false;
    }

}
