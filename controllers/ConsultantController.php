<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

use app\models\EventsService;
use app\models\Client;
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
        )->andWhere([
            'or', ['not', ['events_services.status' => 'consultant_finish']], ['>=', 'events.date', (new \DateTime('tomorrow'))->format('Y-m-d')]
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
                $eventsService->id_consultant = Yii::$app->user->id;
                $eventsService->save();
            }
        }
        return $this->redirect(['view', 'id' => $es]);
    }

    public function actionFinish($id, $es = null)
    {   
        if($eventsService = EventsService::findOne($id)){
            $eventsService->status = 'consultant_finish';
            $eventsService->save();
        }
        return $this->redirect('index');
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
        if(!$form = ConsultantEventForm::findOne($id)){
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('view', [
            'model' => $form,
        ]);
    }
}
