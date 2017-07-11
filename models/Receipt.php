<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "receipts".
 *
 * @property integer $id
 * @property integer $id_client
 * @property integer $sum
 * @property integer $type
 * @property string $date
 */
class Receipt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'receipts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_client', 'sum', 'type'], 'integer'],
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
            'id_client' => 'Id Client',
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
    
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'id_client']);
    }
}
