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
class ConsultantController extends Controller
{
    public $layout = '@app/views/layouts/consultant-sidebar.php';

    public function actionIndex()
    {   
        $eventsServices = EventsService::find()->where(['not', ['code' => null]])->with('idEvent.client', 'computer');
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
        return $this->redirect('index');
    }

    public function actionFinish($id)
    {   
        if($eventsService = EventsService::findOne($id)){
            $eventsService->status = 'consultant_finish';
            $eventsService->save();
        }
        return $this->redirect('index');
    }

    public function actionSearch()
    {   
        if(Yii::$app->request->isPost && !empty(Yii::$app->request->post('code'))){
            if($eventsService = EventsService::find()->where(['code' => Yii::$app->request->post('code')])->one()){
                return $this->redirect(['/client/view', 'id' => $eventsService->idEvent->client->id]);
            }else{
                Yii::$app->session->setFlash('searchError');
            }
        }
        return $this->render('search', [
        ]);
    }
}
