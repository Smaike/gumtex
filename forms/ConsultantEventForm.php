<?php

namespace app\forms;

use Yii;
use yii\helpers\ArrayHelper;

use app\models\Event;
use app\models\Client;
use app\models\Service;
use app\models\EventsService;

/**
 * ContactForm is the model behind the contact form.
 */
class ConsultantEventForm extends EventsService
{
    public function rules()
    {
        $rules = [
            [['tranings'], 'each', 'rule' => ['integer']],
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'id_event']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'id_service']);
    }

    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'id_client'])->viaTable('events', ['id' => 'id_event']);
    }

    public function getTraningsList()
    {
        $tranings = Service::find()->where([
            'type_id' => Service::TYPE_TRANING,
            'status'  => 1,
        ])->orderBy('name')->all();
        return ArrayHelper::map($tranings, 'id', 'name');
    }

    public function saveTranings()
    {
        if($this->validate('tranings')){
            $this->tranings = serialize($this->tranings);
            $this->save(false, ['tranings']);
        }
    }

    public function getTranings()
    {
        return unserialize($this->tranings);
    }

}
