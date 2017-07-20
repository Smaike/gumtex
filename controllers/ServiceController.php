<?php

namespace app\controllers;

use Yii;
use app\models\Event;
use app\models\search\EventSearch;
use app\models\Service;
use app\models\EventsService;
use app\models\Computer;
use app\forms\EventCreateForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * EventController implements the CRUD actions for Event model.
 */
class ServiceController extends Controller
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

    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionStart()
    {
        $computer = Computer::find(Yii::$app->request->get('computer'))->one();
        $computer->is_processed_by = Yii::$app->request->get('id');
        $computer->is_processed = 1;
        $computer->save();
        $eventsService = EventsService::find($computer->is_processed_by)->one();
        $eventsService->status = "processed";
        $eventsService->save();
        return $this->render('start');
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
