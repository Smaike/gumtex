<?php

namespace app\modules\directories\controllers;

use Yii;
use app\models\ServiceTime;
use app\models\search\ServiceTimeSearch;
use app\modules\directories\components\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiceTimeController implements the CRUD actions for ServiceTime model.
 */
class ServiceTimeController extends Controller
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
     * Lists all ServiceTime models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceTimeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServiceTime model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ServiceTime model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServiceTime();

        $models = ServiceTime::find()->all();

        $events = [];
        foreach ($models as $key => $price) {
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $key;
            $Event->title = $price->service->name;
            $Event->allDay = false;
            $Event->dow = $price->dow;
            if(empty($price->dow)){
                $Event->start = $price->date_start . " " . $price->time_start;
                $Event->end = $price->date_end . " " . $price->time_end;
                $Event->ranges = [
                    ['start' => $Event->start, 'end' => $Event->end]
                ];
            }else{
                $Event->ranges = [
                    ['start' => '0001-01-01', 'end' => '3000-01-01']
                ];
                $Event->start = $price->time_start;
                $Event->end = $price->time_end;
            }
            $events[] = $Event;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()){
            $this->refresh();
        }
        return $this->render('create', [
            'model' => $model,
            'events' => $events,
        ]);
        
    }

    /**
     * Updates an existing ServiceTime model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ServiceTime model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ServiceTime model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServiceTime the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServiceTime::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
