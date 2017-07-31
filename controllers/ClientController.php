<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use app\models\Client;
use app\models\ClientRecomendation;
use app\models\ConsultantPoint;
use app\models\EventsService;
use app\models\Paid;
use app\models\Receipt;
use app\models\search\ClientSearch;

/**
 * ClientController implements the CRUD actions for Client model.
 */
class ClientController extends Controller
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
     * Lists all Client models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Client model.
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
     * Creates a new Client model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Client();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Client model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(!empty($model->birthday)){
            $date = strtotime($model->birthday);
            $model->birthday = date('d-m-Y', $date);
        }

        if ($model->load(Yii::$app->request->post())) {
            if(!empty($model->birthday)){
                $date = strtotime($model->birthday);
                $model->birthday = date('Y-m-d', $date);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Client model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionPaid()
    {
        if(Yii::$app->request->isPost){
            $paid = new Paid();
            $paid->id_event = Yii::$app->request->post('id');
            $paid->sum = $paid->event->howmanyCost()-$paid->event->howmanyPaid();
            $paid->date = date("Y-m-d H:i:s");
            $client = $paid->event->client;
            if(($client->balance >= $paid->sum) && $paid->save()){
                $client->balance -= $paid->sum;
                $client->save();
                return true;
            }
        }
        return 0;
    }

    public function actionReceipt()
    {
        if(Yii::$app->request->isPost){
            $receipt = new Receipt();
            $receipt->sum = Yii::$app->request->post('sum');
            $receipt->id_client = Yii::$app->request->post('id');
            $receipt->type = Yii::$app->request->post('type');
            $receipt->date = date("Y-m-d H:i:s");
            if($receipt->save()){
                $client = $receipt->client;
                $client->balance += $receipt->sum;
                $client->save();
                return true;
            }
        }
        return 0;
    }

    public function actionTraningPoints()
    {
        if(Yii::$app->request->isPost){
            foreach(Yii::$app->request->post('tranings') as $traning_id){
                if(!$recomendation = ClientRecomendation::find()->where([
                    'id_service' => $traning_id,
                    'id_client' => Yii::$app->request->post('id'),
                ])->one()){
                    $recomendation = new ClientRecomendation();
                    $recomendation->id_service = $traning_id;
                    $recomendation->id_client = Yii::$app->request->post('id');
                    $recomendation->created_at = date('Y-m-d H:i:s');
                }
                $recomendation->is_visited = 1;
                $recomendation->date_visited = date('Y-m-d H:i:s');
                $recomendation->save();
            }
        }
        return 0;
    }

    /**
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Client::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
