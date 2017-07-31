<?php

namespace app\forms;

use Yii;
use yii\helpers\ArrayHelper;

use app\models\Event;
use app\models\Client;
use app\models\Service;
use app\models\EventsService;
use app\models\ClientRecomendation;

/**
 * ContactForm is the model behind the contact form.
 */
class ConsultantEventForm extends EventsService
{
    public $tranings;

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

    public function saveTranings()
    {
        if(!empty($this->tranings) && $this->validate('tranings')){
            foreach ($this->tranings as $recomendation_id) {
                if(!($recomendation = ClientRecomendation::find()->where([
                    'id_service' => $recomendation_id,
                    'id_client' => $this->client->id
                ])->one())){
                    $recomendation = new ClientRecomendation();
                    $recomendation->id_es = $this->id;
                    $recomendation->id_service = $recomendation_id;
                    $recomendation->id_client = $this->client->id;
                    $recomendation->id_consultant = Yii::$app->user->identity->id;
                    $recomendation->save();
                }
            }
        }
    }

    public function getTranings()
    {
        return unserialize($this->tranings);
    }

}
