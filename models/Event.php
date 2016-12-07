<?php

namespace app\models;

use Yii;
use understeam\calendar\ItemInterface;
use understeam\calendar\ActiveRecordItemTrait;

/**
 * This is the model class for table "events".
 *
 * @property integer $id
 * @property string $date
 * @property string $name
 */
class Event extends \yii\db\ActiveRecord implements ItemInterface
{
    use ActiveRecordItemTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
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
            'date' => 'Date',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'id_client']);
    }

    public function getServices()
    {
        return $this->hasMany(Service::className(), ['id' => 'id_service'])->viaTable('events_services', ['id_event' => 'id']);
    }
}