<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients_events".
 *
 * @property integer $id
 * @property integer $id_event
 * @property integer $id_client
 * @property string $created_at
 */
class Client_event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clients_events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_event', 'id_client'], 'integer'],
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
            'id_event' => 'Id Event',
            'id_client' => 'Id Client',
            'created_at' => 'Created At',
        ];
    }
}
