<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments_dinner".
 *
 * @property integer $id
 * @property integer $sum
 * @property integer $id_user
 * @property string $created_at
 */
class PaymentDinner extends \yii\db\ActiveRecord
{
    const DINNER_COST = 100;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payments_dinner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sum', 'id_user'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sum' => 'Sum',
            'id_user' => 'Id User',
            'created_at' => 'Created At',
        ];
    }
}
