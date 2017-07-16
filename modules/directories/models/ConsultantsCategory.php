<?php

namespace app\modules\directories\models;

use Yii;
use yii\helpers\ArrayHelper;

use app\models\Service;
use app\modules\directories\models\ConsultantsService;

/**
 * This is the model class for table "consultants_categories".
 *
 * @property integer $id
 * @property string $name
 */
class ConsultantsCategory extends \yii\db\ActiveRecord
{
    private $id_services;
    private $id_services_check;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consultants_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            ['id_services', 'each', 'rule' => ['string']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'id_services' => 'Услуги'
        ];
    }

    public function getId_services()
    {
        if(empty($this->id_services)){
            if(!$this->isNewRecord){
                // return 
                return ConsultantsService::find()->select(['id_service'])->where([
                    'id_consultant_category' => $this->id,
                    'status' => 1,
                ])->asArray()->column();
            }else{
                return [];
            }
        }else{
            return $this->id_services;
        }
    }

    public function setId_services($value)
    {
        $this->id_services = $value;
    }

    public static function getListOfServices()
    {
        $services = Service::find()->select(['id', 'name'])->where(['status' => 1])->all();
        return ArrayHelper::map($services, 'id', 'name');
    }

    public function afterSave($insert, $changedAttributes)
    {
        $idsToActive = [];
        $ids = ConsultantsService::find()->select(['id_service'])->where(['id_consultant_category' => $this->id])->asArray()->column();
        ConsultantsService::updateAll(['status' => 0], ['id_consultant_category' => $this->id]);
        foreach ($this->id_services as $key => $id) {
            if(in_array($id, $ids)){
                $idsToActive[] = $id;
            }else{
                $cs = new ConsultantsService();
                $cs->id_service = $id;
                $cs->id_consultant_category = $this->id;
                $cs->status=1;
                $cs->save();
            }
        }
        ConsultantsService::updateAll(['status' => 1], ['id_consultant_category' => $this->id, 'id_service' => $idsToActive]);
        parent::afterSave($insert, $changedAttributes);
    }
}
