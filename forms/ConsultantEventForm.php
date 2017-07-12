<?php

namespace app\forms;

use Yii;
use app\models\Event;
use app\models\Client;
use app\models\Service;
use app\models\EventsService;

/**
 * ContactForm is the model behind the contact form.
 */
class ConsultantEventForm extends EventsService
{

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

}
