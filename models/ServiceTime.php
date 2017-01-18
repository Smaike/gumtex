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
            [['date_start', 'date_end'], 'safe'],
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
        ];
    }

    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'id_service']);
    }
}
