<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_professions".
 *
 * @property integer $id
 * @property integer $id_es
 * @property integer $id_profession
 * @property integer $id_client
 * @property integer $id_consultant
 * @property string $created_at
 */
class ClientProfession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_professions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_es', 'id_profession', 'id_client', 'id_consultant'], 'integer'],
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
            'id_profession' => 'Id Profession',
            'id_client' => 'Id Client',
            'id_consultant' => 'Id Consultant',
            'created_at' => 'Created At',
        ];
    }
}
