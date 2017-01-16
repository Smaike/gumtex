<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prices".
 *
 * @property integer $id
 * @property integer $id_service
 * @property string $date_start
 * @property string $date_end
 * @property string $price
 * @property integer $discount
 * @property integer $client_type_id
 * @property integer $client_category_id
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_service', 'discount', 'client_type_id', 'client_category_id'], 'integer'],
            [['date_start', 'date_end'], 'safe'],
            [['price'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_service' => 'Название услуги',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата конца',
            'price' => 'Цена',
            'discount' => 'Скидка',
            'client_type_id' => 'Тип клиента',
            'client_category_id' => 'Категория клиента',
        ];
    }
}
