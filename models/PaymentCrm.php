<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments_crm".
 *
 * @property integer $id
 * @property integer $sum
 * @property integer $type
 * @property string $descriptions
 * @property string $created_at
 */
class PaymentCrm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payments_crm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sum', 'type'], 'integer'],
            [['descriptions'], 'string'],
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
            'sum' => 'Сумма',
            'type' => 'Тип',
            'descriptions' => 'Объяснение',
            'created_at' => 'Created At',
        ];
    }

    public static function getTypesList()
    {
        return [
            1 => 'Тех-помощь',
            2 => 'Уборщица',
            3 => 'Оплата чеков',
            4 => 'Дополнительный расход',
        ];
    }
}
