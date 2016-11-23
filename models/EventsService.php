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
            [['id_event', 'id_service'], 'integer'],
            [['id_event'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['id_event' => 'id']],
            [['id_service'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['id_service' => 'id']],
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
        return $this->hasOne(Events::className(), ['id' => 'id_event']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdService()
    {
        return $this->hasOne(Services::className(), ['id' => 'id_service']);
    }
}
