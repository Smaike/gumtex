<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_recomendations".
 *
 * @property integer $id
 * @property integer $id_es
 * @property integer $id_service
 * @property integer $id_client
 * @property integer $id_consultant
 * @property string $created_at
 */
class ClientRecomendation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_recomendations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_es', 'id_service', 'id_client', 'id_consultant'], 'integer'],
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
            'id_service' => 'Id Service',
            'id_client' => 'Id Client',
            'id_consultant' => 'Id Consultant',
            'created_at' => 'Created At',
        ];
    }
}
