<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

use app\models\EventsService;
use app\models\Client;
use app\models\Event;
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
        if(Yii::$app->request->isPost && $payment->load(Yii::$app->request->post())){
            $payment->created_at = date('Y-m-d');
            $payment->save();
            return $this->redirect(['expenses']);
        }
        return $this->render('expenses', [
            'model' => $payment,
        ]);
    }

    public function actionIncomes()
    {   
        $payment = new PaymentCrm();
        if(Yii::$app->request->isPost && $payment->load(Yii::$app->request->post())){
            $payment->type = 5;
            $payment->created_at = date('Y-m-d');
            $payment->save();
            return $this->redirect(['incomes']);
        }
        return $this->render('incomes', [
            'model' => $payment,
        ]);
    }

    public function actionDailyReport()
    {
        $time = date('Y-m-d H:i:s');
        $queryQ1 = Yii::$app->db->createCommand("
            SELECT services.name, sum(prices.price) as sum, count(events_services.id_service) as cnt
            FROM events_services
            LEFT JOIN prices on prices.id_service = events_services.id_service
            LEFT JOIN services on services.id = events_services.id_service
            WHERE events_services.consultant_end BETWEEN '".date('Y-m-d 00:00:00')."' AND '$time'
            GROUP BY events_services.id_service
        ")->queryAll();

        $queryQ2 = Event::find()
        ->joinWith('paids')
        ->where(['between', 'events.date', date('Y-m-d 00:00:00'), $time])
        ->sum('paids.sum');

        $queryQ3 = Yii::$app->db->createCommand("
            SELECT clients.last_name as lastname, events.discount as discount, events.why as why
            FROM events
            LEFT JOIN clients on clients.id = events.id_client
            WHERE events.date BETWEEN '".date('Y-m-d 00:00:00')."' AND '$time' 
            AND events.discount is not null

        ")->queryAll();

        $queryQ4 = Yii::$app->db->createCommand("
            SELECT sum(paids.sum) as sum
            FROM paids
            WHERE paids.date > '".date('Y-m-d 00:00:00')."' 

        ")->queryScalar();
        
        return $this->render('daily-report', [
            'queryQ1' => $queryQ1,
            'queryQ2' => $queryQ2,
            'queryQ3' => $queryQ3,
            'queryQ4' => $queryQ4,
        ]);
    }
    
}
