<?php

namespace app\modules\directories\models;

use Yii;

/**
 * This is the model class for table "consultants_cost".
 *
 * @property integer $id
 * @property integer $id_consultant_type
 * @property integer $id_service
 * @property string $value
 */
class ConsultantsCost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consultants_cost';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_consultant_type', 'id_service'], 'integer'],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_consultant_type' => 'Id Consultant Type',
            'id_service' => 'Id Service',
            'value' => 'Value',
        ];
    }
}
