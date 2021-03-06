<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

use app\models\EventsService;
use app\models\Client;

/**
 * EventController implements the CRUD actions for Event model.
 */
class ReportController extends Controller
{
    public function actionIndex()
    {   
        $eventsServices = EventsService::find()->where(['NOT', ['url_report' => null]])->with('idEvent.client');
        $dp = new ActiveDataProvider([
            'query' => $eventsServices,
        ]);
        return $this->render('index', [
            'dataProvider' => $dp,
        ]);
    }
}
