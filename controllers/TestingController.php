<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\models\Event;
use app\models\Service;
use app\models\Computer;
use app\models\EventsService;

/**
 * EventController implements the CRUD actions for Event model.
 */
class TestingController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        $computer = Computer::find(1)->one();
        $eventsService = EventsService::find($computer->is_processed_by)->one();
        return $this->render('index', [
            'eventsService' => $eventsService,
        ]);
    }
}
