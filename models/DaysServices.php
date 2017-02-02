<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "days_services".
 *
 * @property integer $id
 * @property integer $id_service
 * @property integer $day
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
            [['id_service', 'day'], 'integer'],
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
            'day' => 'Day',
        ];
    }
}
