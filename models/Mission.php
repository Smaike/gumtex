<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "missions".
 *
 * @property integer $id
 * @property string $theme
 * @property string $description
 * @property integer $status
 * @property integer $id_created
 * @property integer $is_report
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property MissionsFiles[] $missionsFiles
 * @property MissionsUsers[] $missionsUsers
 */
class Mission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'missions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['status', 'id_created', 'is_report', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['theme'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'theme' => 'Theme',
            'description' => 'Description',
            'status' => 'Status',
            'id_created' => 'Id Created',
            'is_report' => 'Is Report',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMissionsFiles()
    {
        return $this->hasMany(MissionsFiles::className(), ['id_mission' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMissionsUsers()
    {
        return $this->hasMany(MissionsUsers::className(), ['id_mission' => 'id']);
    }
}
