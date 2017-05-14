<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property integer $id
 * @property string $title
 * @property string $filename
 * @property string $ext
 * @property string $created_at
 *
 * @property MissionsFiles[] $missionsFiles
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['filename', 'ext'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'filename' => 'Filename',
            'ext' => 'Ext',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMissionsFiles()
    {
        return $this->hasMany(MissionsFiles::className(), ['id_file' => 'id']);
    }
}
