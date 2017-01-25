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
            [['date_start', 'date_end', 'time_start', 'time_end', 'dow'], 'safe'],
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
}
