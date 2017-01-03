<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

use app\models\Event;
use app\models\Service;
use app\models\Computer;
use app\models\EventsService;

/**
 * EventController implements the CRUD actions for Event model.
 */
class ConsultantController extends Controller
{
    public function actionIndex()
    {   
        $eventsServices = EventsService::find()->where(['status' => 'consultant'])->with('idEvent.client', 'computer');
        $dp = new ActiveDataProvider([
            'query' => $eventsServices,
        ]);
        return $this->render('index', [
            'dataProvider' => $dp,
        ]);
    }
}
