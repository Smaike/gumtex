<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

use app\models\EventsService;
use app\models\Client;
use app\models\ConsultantPoint;
use app\models\User;
use app\models\PaymentDinner;
use app\models\PaymentCrm;
use app\forms\ConsultantEventForm;

/**
 * EventController implements the CRUD actions for Event model.
 */
class PaymentController extends Controller
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
        return $this->render('index');
    }

    public function actionDinner()
    {   
        $consultants = User::find()->where(['in', 'id', 
            (new yii\db\Query())
            ->select('id_consultant')
            ->from('events_services')
            ->where("created_at > '" . date('Y-m-d') . "' and created_at < '" . (new \DateTime('tomorrow'))->format('Y-m-d') . "'")])
        ->orWhere(['id' => Yii::$app->user->id]);
        $dp = new ActiveDataProvider([
            'query' => $consultants,
        ]);
        return $this->render('dinner', [
            'consultants' => $consultants->all(),
            'dp' => $dp,
        ]);
    }

    public function actionAjaxDinner()
    {   
        foreach (Yii::$app->request->post('keys') as $key) {
            $payment = new PaymentDinner();
            $payment->sum = PaymentDinner::DINNER_COST;
            $payment->created_at = date('Y-m-d');
            $payment->id_user = $key;
            $payment->save();
        }
        return true;
    }
    public function actionExpenses()
    {   
        $payment = new PaymentCrm();
        return $this->render('expenses', [
            'model' => $payment,
        ]);
    }
    
}
