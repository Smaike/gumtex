<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


use app\models\Client;
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
        if(Event::find()->where(['date' => $date])->count() >= 6){
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model = new EventCreateForm();
        $model->date = $date;
        $p_time = explode(' ', $date)[1];
        $services = ServiceTime::find()
            ->where(['<=', 'date_start', $date])
            ->andWhere(['>=', 'date_end', $date])
            ->andWhere(['<=', 'time_start', $p_time])
            ->andWhere(['>=', 'time_end', $p_time])
            ->joinWith('service')
            ->andWhere(['services.status' => 1])
            ->all();
        $aServices = [];
        foreach ($services as $key => $service) {
            if(!empty($service->dow) && in_array(date('w', strtotime($date)), $service->dow) && !empty($service->service)){
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
        $form = new EventCreateForm();
        $form->attributes = $model->client->attributes;
        $form->attributes = $model->attributes;
        $form->services = $model->getServices()->select(['id'])->column();
        $date = $form->date;
        $p_time = explode(' ', $date)[1];
        $services = ServiceTime::find()
            ->where(['<=', 'date_start', $date])
            ->andWhere(['>=', 'date_end', $date])
            ->andWhere(['<=', 'time_start', $p_time])
            ->andWhere(['>=', 'time_end', $p_time])
            ->with('service')
            ->all();
        $aServices = [];
        foreach ($services as $key => $service) {
            if(!empty($service->dow) && in_array(date('w', strtotime($date)), $service->dow)){
                $aServices[$service->id_service] = $service->service->name;
            }
        }
        if ($form->load(Yii::$app->request->post()) && $form->update()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            // $dt = strtotime($form->birthday);
            // $form->birthday = date('d-m-Y', $dt);
            return $this->render('create', [
                'model' => $form,
                'aServices' => $aServices,
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
        $model = $this->findModel($id);
        $model->status = 0;
        $model->save();

        return $this->redirect(['calendar/index']);
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
        $cost = 0;
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

    public function actionSeparate($id)
    {
        $model = $this->findModel($id);
        $model->status = 2;
        $model->save();
        return $this->redirect(['calendar/index']);
    }

    public function actionBind($date)
    {
        $models = Event::find()->where(['status' => 2])->all();

        if($id = Yii::$app->request->post('id')){
            $model = Event::findOne($id);
            $model->date = $date;
            $model->status = 1;
            $model->save();
            return $this->redirect(['calendar/index']);
        }

        return $this->render('bind', [
            'models' => $models,
        ]);
    }

    public function actionPrint($date)
    {
        $period[0] = date('Y-m-d', strtotime($date));
        $period[1] = date('Y-m-d H:i:s', strtotime($date)  + 60*60*24);
        $models = Event::find()->andWhere([
            'AND',
            [
                '>=',
                'date',
                $period[0],
            ],
            [
                '<',
                'date',
                $period[1],
            ],
        ])->all();
        $content = $this->renderPartial('_print', [
            'models' => $models
        ]);
        $pdf = Yii::$app->pdf;
        $pdf->content = $content;
        return $pdf->render();
    }

    public function actionCopies()
    {
        $last = Yii::$app->request->post('last');
        $first = Yii::$app->request->post('first');
        $middle = Yii::$app->request->post('middle');
        $age = Yii::$app->request->post('age');
        if($last || $first || $middle || $age){
            $models = Client::find()->andFilterWhere(['like', 'last_name', $last])
            ->andFilterWhere(['like', 'first_name', $first])
            ->andFilterWhere(['like', 'middle_name', $middle])
            ->andFilterWhere(['age' => $age])->limit(10)->all();
        }else{
            $models = [];
        }
        return $this->renderPartial('_copies', [
            'models' => $models
        ]);
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
