<?php

namespace app\models;

use Yii;
use app\components\booking\ItemInterface;
use app\components\booking\ActiveRecordItemTrait;

/**
 * This is the model class for table "booking".
 *
 * @property integer $id
 * @property string $date
 * @property integer $room_id
 * @property integer $status
 */
class Booking extends \yii\db\ActiveRecord implements ItemInterface
{
    use ActiveRecordItemTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['room_id', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'room_id' => 'Room ID',
            'status' => 'Status',
        ];
    }
}
