<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "active_days".
 *
 * @property integer $id
 * @property string $date
 * @property string $split
 * @property integer $is_active
 */
class ActiveDay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'active_days';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'required'],
            ['date', 'date', 'format' => 'yyyy-mm-dd'],

            [['is_active'], 'integer'],
            [['split'], 'string', 'max' => 2],
            [['start', 'end'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'split' => 'Разбитие',
            'is_active' => 'Активен?',
            'start' => 'Начало',
            'end' => 'Конец',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // var_dump($this->attributes);
            return true;
        }
    }
}
