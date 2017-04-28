<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\models\Client;
use app\models\Computer;
use app\models\Event;
use app\models\EventsService;
use app\models\Service;

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
        if(!empty(Yii::$app->request->post('code'))){
            if($eventsService = EventsService::find()->where(['code' => Yii::$app->request->post('code')])->one()){
                return $this->redirect(['check', 'code' => Yii::$app->request->post('code')]);
            }else{
                Yii::$app->getSession()->setFlash('warning', 'Указанный код не найден');
            }
        }
        return $this->render('index', [
        ]);
    }

    public function actionCheck($code)
    {   
        $this->layout = 'testing';
        if($eventsService = EventsService::find()->where(['code' => Yii::$app->request->post('code')])->one()){
            $model = $eventsService->idEvent->client;
            if(!empty($model->birthday)){
                $date = strtotime($model->birthday);
                $model->birthday = date('d-m-Y', $date);
            }
            if($model->load(Yii::$app->request->post())){
                if(!empty($model->birthday)){
                    $date = strtotime($model->birthday);
                    $model->birthday = date('Y-m-d', $date);
                }
                $model->save();
                Yii::$app->soap->sc->createTestingSession($eventsService->idService->ht_name, $eventsService->session);
                $url = Yii::$app->soap->sc->getTestingSessionUrl($eventsService->session);
                var_dump($url);
                die;
                return $this->redirect($url['TestingSessionUrl']);
            }
            return $this->render('check', [
                'model' => $model,
            ]);
        }else{
            Yii::$app->getSession()->setFlash('warning', 'Указанный код не найден');
        }
    }

    public function actionTestFinish()
    {   
        if($eventsService = EventsService::find()->where([
            'session' => Yii::$app->request->get('ExternalSessionGuid')
        ])->one()){
            $eventsService->status = 'consultant';
            $eventsService->url_report = Yii::$app->soap->sc->getResultsReportUrl($eventsService->session)['ResultsReportUrl'];
            $eventsService->save();
            return true;
        }else{
            return false;
        }
    }

    public function actionReport($id)
    {
        $eventsService = EventsService::findOne($id);
        var_dump(Yii::$app->soap->sc->getResultsReportHtml($eventsService->session, 0, 0));
        die;
        return Yii::$app->soap->sc->getResultsReportHtml($eventsService->session, 0, 0)['ReportContentHtml'];
        // return $this->redirect(Yii::$app->soap->sc->getResultsReportUrl($eventsService->session)['ResultsReportUrl']);
    }
}
