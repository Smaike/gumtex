<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_discount".
 *
 * @property integer $id
 * @property integer $id_service
 * @property integer $id_category
 * @property integer $id_type
 * @property string $value
 */
class ClientDiscount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_discount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_service', 'id_category', 'id_type'], 'integer'],
            [['value'], 'string', 'max' => 11],
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
            'id_category' => 'Id Category',
            'id_type' => 'Id Type',
            'value' => 'Value',
        ];
    }
}
