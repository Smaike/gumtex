<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "consultant_points".
 *
 * @property integer $id
 * @property integer $id_es
 * @property integer $id_consultant
 * @property string $created_at
 */
class ConsultantPoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consultant_points';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_es', 'id_consultant', 'id_service'], 'integer'],
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
            'id_es' => 'Id Es',
            'id_consultant' => 'Id Consultant',
            'created_at' => 'Created At',
        ];
    }

    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'id_service']);
    }

    public function getEs()
    {
        return $this->hasOne(EventsService::className(), ['id' => 'id_es']);
    }
}
