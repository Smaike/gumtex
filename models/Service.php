<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "services".
 *
 * @property integer $id
 * @property string $name
 * @property integer $cost
 * @property string $created_at
 * @property string $updated_at
 *
 * @property EventsServices[] $eventsServices
 */
class Service extends \yii\db\ActiveRecord
{
    const TYPE_TRANING = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cost', 'type_id'], 'integer'],
            [['type_id', 'name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 60],
            [['ht_name'], 'string', 'max' => 50],
            ['status', 'default', 'value' => 1],
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
            'cost' => 'Стоимость',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ht_name' => 'Имя в системе HT',
            'type_id' => 'Категория услуг',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventsServices()
    {
        return $this->hasMany(EventsServices::className(), ['id_service' => 'id']);
    }

    public function getServiceType()
    {
        return $this->hasOne(ServiceType::className(), ['id' => 'type_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->created_at = date("Y-m-d H:i:s");
            }
            $this->updated_at = date("Y-m-d H:i:s");
            return true;
        }
        return false;
    }
    // public function afterDelete()
    // {
    //     if (parent::afterDelete()) {
    //         ServiceTime::find()->where(['id_service' => $this->])
    //         return true;
    //     }
    //     return false;
    // }

    public static function getTraningsList()
    {
        $tranings = Service::find()->where([
            'type_id' => Service::TYPE_TRANING,
            'status'  => 1,
        ])->orderBy('name')->all();
        return ArrayHelper::map($tranings, 'id', 'name');
    }

    public static function getServicesList()
    {
        $services = Service::find()
            ->andWhere(['status' => 1])
            ->all();
        foreach ($services as $key => $service) {
            $aServices[$service->serviceType->name][$service->id] = $service->name;
        }
        return $aServices;
    } 
}
