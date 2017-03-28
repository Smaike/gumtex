<?php

namespace app\modules\directories\models;

use Yii;

/**
 * This is the model class for table "consultants_services".
 *
 * @property integer $id
 * @property integer $id_consultant_category
 * @property integer $id_service
 * @property integer $status
 */
class ConsultantsService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consultants_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_consultant_category', 'id_service', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_consultant_category' => 'Id Consultant Category',
            'id_service' => 'Id Service',
            'status' => 'Status',
        ];
    }
}
