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
            [['date'], 'safe'],
            [['is_active'], 'integer'],
            [['split'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'split' => 'Split',
            'is_active' => 'Is Active',
        ];
    }
}
