<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

use app\models\EventsService;
use app\models\Client;
use app\models\ClientRecomendation;
use app\forms\ConsultantEventForm;

/**
 * EventController implements the CRUD actions for Event model.
 */
class ConsultantController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {   
        $eventsServices = EventsService::find()->joinWith(['idEvent'])
        ->where(
            ['not', ['code' => null]]
        )
        ->andWhere([
            'not', ['events_services.status' => 'consultant_finish']
        ])->andWhere([
            '>=', 'events.date', (new \DateTime())->format('Y-m-d')
        ])
        ->andWhere([
            '<', 'events.date', (new \DateTime('tomorrow'))->format('Y-m-d')
        ]);
        $dp = new ActiveDataProvider([
            'query' => $eventsServices,
        ]);
        return $this->render('index', [
            'dataProvider' => $dp,
        ]);
    }

    public function actionTake($id)
    {   
        if($eventsService = EventsService::findOne($id)){
            $eventsService->status = 'consultant_progress';
            $eventsService->id_consultant = Yii::$app->user->id;
            $eventsService->save();
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionTakeAll($id, $es)
    {   
        if($eventsServices = EventsService::find()->where(['id_event' => $id])->all()){
            foreach ($eventsServices as $key => $eventsService) {
                $eventsService->status = 'consultant_progress';
                $eventsService->consultant_start = date('Y-m-d H:i:s');
                $eventsService->id_consultant = Yii::$app->user->id;
                $eventsService->save();
            }
        }
        return $this->redirect(['view', 'id' => $es]);
    }

    public function actionSearch()
    {   
        $this->layout = '@app/views/layouts/consultant-sidebar.php';
        if(Yii::$app->request->isPost && !empty(Yii::$app->request->post('code'))){
            if($eventsService = EventsService::find()->where(['code' => Yii::$app->request->post('code')])->one()){
                return $this->redirect(['view', 'id' => $eventsService->id]);
            }else{
                Yii::$app->session->setFlash('searchError');
            }
        }
        return $this->render('search', [
        ]);
    }

    public function actionView($id)
    {   
        $this->layout = '@app/views/layouts/consultant-sidebar.php';
        $csv = str_getcsv(file_get_contents(Yii::getAlias('@app').'/prof.csv'),';','"');
        if(!$form = ConsultantEventForm::findOne($id)){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        if(Yii::$app->request->isPost){
            $form->load(Yii::$app->request->post());
            $form->saveTranings();
            EventsService::updateAll([
                'status' => 'consultant_finish',
                'consultant_end' => date('Y-m-d H:i:s')
            ], [
                'id_event' => $form->id_event
            ]);
            return $this->redirect('search');
        }
        return $this->render('view', [
            'model' => $form,
            'professions' => $csv,
        ]);
    }

    public function actionPoints()
    {   
        $this->layout = '@app/views/layouts/consultant-sidebar.php';
        $models = ClientRecomendation::find()->where(['id_consultant' => Yii::$app->user->id])->all();
        return $this->render('points', [
            'models' => $models,
        ]);
    }

    public function actionPdfReport($id)
    {
        $es = EventsService::findOne($id);
        libxml_use_internal_errors(true);
        $pdf = Yii::$app->pdf;
        $d = new \DOMDocument('1.0', 'UTF-8');
        $html = Yii::$app->soap->sc->getResultsReportHtml($es->session, 0, 1)['ReportContentHtml'];
        $d->loadHTML($html);
        $head="";
        foreach ($d->getElementsByTagName('body') as $key => $value) {
        //     if($key<9){
                $head .= $value->nodeValue;
        //     }
        }
        file_put_contents(Yii::getAlias("@runtime").'/test.html', base64_decode($head));
        // $pdf->content = file_get_contents($es->url_report);
        // $pdf->cssFile = Yii::getAlias("@runtime").'/test.css';
        // return $pdf->render();
        return base64_decode($head).'<script>window.print();</script>';
        // var_dump($html);
        return true;
    }
}
