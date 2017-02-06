<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


use app\models\ClientDiscount;
use app\models\Event;
use app\models\Service;
use app\models\ServiceTime;
use app\models\Price;
use app\models\search\EventSearch;
use app\forms\EventCreateForm;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
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
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Event model.
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
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $date = Yii::$app->request->get('date');

        $model = new EventCreateForm();
        $model->date = $date;
        $p_time = explode(' ', $date)[1];
        $services = ServiceTime::find()
            ->where(['<=', 'date_start', $date])
            ->andWhere(['>=', 'date_end', $date])
            ->andWhere(['<=', 'time_start', $p_time])
            ->andWhere(['>=', 'time_end', $p_time])
            ->with('service')
            ->all();
        foreach ($services as $key => $service) {
            if(!empty($service->dow) && in_array(date('w', strtotime($date)), $service->dow)){
                $aServices[$service->id_service] = $service->service->name;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['calendar/index', 'date' => date("Y-m-d",strtotime($model->date)), 'viewMode' => 'day']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'aServices' => $aServices,
            ]);
        }
    }

    /**
     * Updates an existing Event model.
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
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCost()
    {
        if(!Yii::$app->request->isAjax){
            return "Oh, go away";
        }
        $post = Yii::$app->request->post('services');
        $date = Yii::$app->request->post('date');
        $cat = Yii::$app->request->post('category');
        $type = Yii::$app->request->post('type');

        $query = Price::find()
            ->where(['<=', 'date_start', $date])
            ->andWhere(['id_service' => $post]);
        $services = $query->all();
        foreach ($services as $service) {
            $price = $service->price;
            //Сделать херь со скидками
            $dis1 = $service->getDiscountCategory($cat);
            $dis2 = $service->getDiscountType($type);
            if($dis1 > $dis2){
                $price = $price - $price*$dis1/100;
            }else{
                $price = $price - $price*$dis2/100;
            }
            $cost+= $price;
        }
        return $cost;
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
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
