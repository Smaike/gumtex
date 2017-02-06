<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_times".
 *
 * @property integer $id
 * @property integer $id_service
 * @property string $date_start
 * @property string $date_end
 */
class ServiceTime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_times';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_service'], 'integer'],
            ['date_start', 'default', 'value' => '0000-01-01'],
            ['date_end', 'default', 'value' => '3000-01-01'],
            [['date_start', 'date_end', 'time_start', 'time_end', 'dow'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'id_service' => 'Название услуги',
            'date_start' => 'Дата начала',
            'date_end'   => 'Дата конца',
            'time_start' => 'Время начала',
            'time_end'   => 'Время конца',
            'dow'        => 'Дни недели',
        ];
    }

    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'id_service']);
    }

    public function __set($name, $value) {
       if ($name === 'dow') {
          $this->setAttribute('dow', serialize($value));
       } else {
          parent::__set($name, $value);
       }
    }
     
    public function __get($name) {
       if ($name === 'dow') {
          return unserialize($this->getAttribute('dow'));
       }
       return parent::__get($name);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        foreach ($this->dow as $day) {
            $daysServices = new DaysServices();
            $daysServices->id_service = $this->id;
            $daysServices->day = $day;
            $daysServices->save();
        }
    }
}