<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_types".
 *
 * @property integer $id
 * @property string $name
 */
class ClientType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название типа',
        ];
    }
}
