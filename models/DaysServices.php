<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "days_services".
 *
 * @property integer $id
 * @property integer $id_service
 * @property integer $service_type
 * @property integer $monday
 * @property integer $tuesday
 * @property integer $wednesday
 * @property integer $thursday
 * @property integer $friday
 * @property integer $saturday
 * @property integer $sunday
 * @property string $start
 * @property string $end
 */
class DaysServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'days_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_service', 'service_type', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'], 'integer'],
            [['start', 'end'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_service' => 'Id Service',
            'service_type' => 'Service Type',
            'monday' => 'Понедельник',
            'tuesday' => 'Вторник',
            'wednesday' => 'Среда',
            'thursday' => 'Четверг',
            'friday' => 'Пятница',
            'saturday' => 'Суббота',
            'sunday' => 'Воскресенье',
            'start' => 'Начало',
            'end' => 'Конец',
        ];
    }
}
