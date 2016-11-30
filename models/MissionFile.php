<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "missions_files".
 *
 * @property integer $id
 * @property integer $id_mission
 * @property integer $id_file
 *
 * @property Files $idFile
 * @property Missions $idMission
 */
class MissionFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'missions_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mission', 'id_file'], 'integer'],
            [['id_file'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['id_file' => 'id']],
            [['id_mission'], 'exist', 'skipOnError' => true, 'targetClass' => Missions::className(), 'targetAttribute' => ['id_mission' => 'id']],
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
            'id_file' => 'Id File',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'id_file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMission()
    {
        return $this->hasOne(Missions::className(), ['id' => 'id_mission']);
    }
}
