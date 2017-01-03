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
        $this->layout = 'testing';
        $computer = Computer::find(1)->one();
        $eventsService = EventsService::find($computer->is_processed_by)->one();
        // $eventsService->session = \Yii::$app->security->generateRandomString();
        // $eventsService->save();
        Yii::$app->soap->sc->createTestingSession($eventsService->idService->ht_name, $eventsService->session);
        $url = Yii::$app->soap->sc->getTestingSessionUrl($eventsService->session);
        return $this->redirect($url['TestingSessionUrl']);
        // var_dump($url);
        // die;
        return $this->render('index', [
            'eventsService' => $eventsService,
            'url' => $url['TestingSessionUrl']
        ]);
    }

    public function actionTestFinish()
    {   
        if($eventsService = EventsService::find()->where([
            'session' => Yii::$app->request->get('ExternalSessionGuid')
        ])->one()){
            $eventsService->status = 'consultant';
            $eventsService->save();
            return true;
        }else{
            return false;
        }
    }

    public function actionReport()
    {
        $computer = Computer::find(1)->one();
        $eventsService = EventsService::find($computer->is_processed_by)->one();
        // return Yii::$app->soap->sc->getResultsReportHtml($eventsService->session, 0, 0)['ReportContentHtml'];
        return $this->redirect(Yii::$app->soap->sc->getResultsReportUrl($eventsService->session)['ResultsReportUrl']);
    }
}
