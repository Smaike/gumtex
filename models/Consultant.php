<?php

namespace app\models;

use Yii;
use app\modules\directories\models\ConsultantsCategory;
use app\modules\directories\models\ConsultantsType;

/**
 * This is the model class for table "consultants".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_category
 * @property integer $id_type
 */
class Consultant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consultants';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_category', 'id_type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Пользователь',
            'id_category' => 'Категория',
            'id_type' => 'Тип',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
    public function getCat()
    {
        return $this->hasOne(ConsultantsCategory::className(), ['id' => 'id_category']);
    }
    public function getType()
    {
        return $this->hasOne(ConsultantsType::className(), ['id' => 'id_type']);
    }
}
