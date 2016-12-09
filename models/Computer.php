<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comptuters".
 *
 * @property integer $id
 * @property string $name
 * @property string $ip
 * @property integer $is_processed
 * @property integer $is_processed_by
 *
 * @property Clients $isProcessedBy
 */
class Computer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comptuters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_processed', 'is_processed_by'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['ip'], 'string', 'max' => 15],
            [['is_processed_by'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['is_processed_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'ip' => 'Ip',
            'is_processed' => 'Занят?',
            'is_processed_by' => 'Кем занят',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIsProcessedBy()
    {
        return $this->hasOne(Client::className(), ['id' => 'is_processed_by']);
    }
}
