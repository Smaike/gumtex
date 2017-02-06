<?php

namespace app\modules\directories\controllers;

use Yii;
use app\modules\directories\components\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Price;
use app\models\search\PriceSearch;
use app\models\ClientDiscount;

/**
 * PriceController implements the CRUD actions for Price model.
 */
class PriceController extends Controller
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
     * Lists all Price models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PriceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Price model.
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
     * Creates a new Price model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Price();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->saveDiscounts($model);
            return $this->redirect(['update', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
        
    }

    /**
     * Updates an existing Price model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->saveDiscounts($model);
            return $this->redirect(['update', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
        
    }

    /**
     * Deletes an existing Price model.
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
     * Finds the Price model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Price the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Price::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddPeriod()
    {
        $model = new Price();
        return $this->renderAjax('_period', [
            'model' => $model,
        ]);
    }

    private function saveDiscounts($model)
    {
        foreach (Yii::$app->request->post('category') as $key => $row) {
            if(!$discount = ClientDiscount::find()->where(['id_service' => $model->id, 'id_category' => $key])->one()){
                $discount = new ClientDiscount();
                $discount->id_service = $model->id;
                $discount->id_category = $key;
            }
            $discount->value = $row;
            $discount->save();
        }
        foreach (Yii::$app->request->post('type') as $key => $row) {
            if(!$discount = ClientDiscount::find()->where(['id_service' => $model->id, 'id_type' => $key])->one()){
                $discount = new ClientDiscount();
                $discount->id_service = $model->id;
                $discount->id_type = $key;
            }
            $discount->value = $row;
            $discount->save();
        }
    }
}
