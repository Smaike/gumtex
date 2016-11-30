<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "missions_users".
 *
 * @property integer $id
 * @property integer $id_mission
 * @property integer $id_user
 *
 * @property Missions $idMission
 * @property Users $idUser
 */
class MissionUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'missions_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mission', 'id_user'], 'integer'],
            [['id_mission'], 'exist', 'skipOnError' => true, 'targetClass' => Missions::className(), 'targetAttribute' => ['id_mission' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_mission' => 'Id Mission',
            'id_user' => 'Id User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMission()
    {
        return $this->hasOne(Missions::className(), ['id' => 'id_mission']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }
}
