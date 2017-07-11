<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events_services".
 *
 * @property integer $id
 * @property integer $id_event
 * @property integer $id_service
 *
 * @property Events $idEvent
 * @property Services $idService
 */
class EventsService extends \yii\db\ActiveRecord
{
    private $statuses = [
        'new'                 => "Код сгенерирован",
        'processed'           => "Тестируется",
        'consultant'          => "Закончил тестирование",
        'consultant_progress' => "Консультация",
        'consultant_finish'   => "Закончил консультацию",
    ];

    private $colors = [
        'new'                 => "#93bbef",
        'processed'           => "#cef790",
        'consultant'          => "#f5e87a",
        'consultant_progress' => "#e6a9f1",
        'consultant_finish'   => "#f7a7a1",
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_event', 'id_service', 'id_consultant'], 'integer'],
            [['id_event'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['id_event' => 'id']],
            [['id_service'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['id_service' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_event' => 'Id Event',
            'id_service' => 'Id Service',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'id_event']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdService()
    {
        return $this->hasOne(Service::className(), ['id' => 'id_service']);
    }

    public function getConsultant()
    {
        return $this->hasOne(User::className(), ['id' => 'id_consultant']);
    }

    public function getComputer()
    {
        return $this->hasOne(Computer::className(), ['is_processed_by' => 'id']);
    }

    public function getStatusLabel()
    {
        return $this->statuses[$this->status];
    }

    public function getInWorkColor()
    {
        return "background-color:" . $this->colors[$this->status];
    }
    
    public function getConsultantName()
    {
        if($consultant = $this->consultant){
            return $consultant->fullName;
        }
        return "-";
    }
}
