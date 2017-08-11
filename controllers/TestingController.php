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
            ]
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
            if($eventsService = EventsService::find()->where([
                'code' => Yii::$app->request->post('code'),
                'status' => ['new', 'processed']
            ])->one()){
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
        
        //Ищем только со статусом новый и в процессе. 
        if($eventsService = EventsService::find()->where([
            'code' => Yii::$app->request->get('code'),
            'status' => ['new', 'processed']
        ])->one()){
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
                if($eventsService->status == 'new'){
                    Yii::$app->soap->sc->createTestingSession($eventsService->idService->ht_name, $eventsService->session, 1);
                    $cl = $eventsService->idEvent->client;
                    //Отправляем данные ht чтобы они смогли составить отчет.
                    $callb = Yii::$app->soap->sc->setSessionRespondent($eventsService->session, 
                        $cl->last_name,
                        $cl->first_name,
                        $cl->middle_name,
                        $cl->first_name,
                        $cl->birthday,
                        $cl->age,
                        ($cl->gender == 'М')?'m':'f',
                        $cl->email,
                        $cl->mobile,
                        $cl->grade,
                        $cl->hobby,
                        $eventsService->code
                    );
                    $eventsService->test_start = date('Y-m-d H:i:s');
                }
                $eventsService->status = 'processed';
                $eventsService->save(false);
                $url = Yii::$app->soap->sc->getTestingSessionUrlEx($eventsService->session);
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
            $eventsService->test_end = date('Y-m-d H:i:s');
            $eventsService->save();
            return true;
        }else{
            return false;
        }
    }

    public function actionReport($id)
    {
        $this->layout = 'testing';
        $eventsService = EventsService::findOne($id);
        // Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        // Yii::$app->response->headers->add('Content-Type', 'text/xml');
        $content = Yii::$app->soap->sc->getResultsReportXml($eventsService->session, 0, 0)['ReportContentXml'];
        // var_dump($content);
        $data = new \SimpleXMLElement($content);
        $helper = new \app\components\ReportHelper($data);
        // echo "<pre>";
        // var_dump($data->TestingReports->TestingReport->ReportBlocks->ReportBlock[3]->Scales->children());
        // // echo $data->children();
        
        // $helper->texts;
        // echo "</pre>";
        // var_dump($circle1);die;
        // return $data->asXML();
        return $this->render('test', [
            'circle1' => $helper->firstCircleParams,
            'helper' => $helper,
            'model' => $eventsService,
        ]);
    }

    public function actionTest()
    {
        return $this->renderPartial('test', [
        ]);
    }
}
