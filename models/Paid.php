<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paids".
 *
 * @property integer $id
 * @property integer $id_event
 * @property integer $sum
 * @property integer $type
 * @property string $date
 */
class Paid extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paids';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_event', 'sum', 'type'], 'integer'],
            [['date'], 'safe'],
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
            'sum' => 'Sum',
            'type' => 'Type',
            'date' => 'Date',
        ];
    }

    public static function getTypes()
    {
        return [
            1 => 'Наличные',
            // 2 => 'Аванас наличные',
            3 => 'Безнал',
            // 4 => 'Аванас безнал',
        ];
    }

    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'id_event']);
    }
}
