<?php

namespace app\modules\directories\models;

use Yii;
use app\modules\directories\models\ConsultantsCost;

/**
 * This is the model class for table "consultants_types".
 *
 * @property integer $id
 * @property string $name
 */
class ConsultantsType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consultants_types';
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

    public function getCostService($id)
    {
        if($cost = ConsultantsCost::find()->where(['id_service' => $id, 'id_consultant_type' => $this->id])->one()){
            return $cost->value;
        }
        return 0;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
}
