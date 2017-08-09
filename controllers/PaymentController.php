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

    /**
    
        TODO:
        - queryQ1 - Собираем все оказанные услуги за сегодня, цена берется из справочников.
        - queryQ2 - Платежи, полученные за события, которые прошли сегодня. Сумма может отличаться от суммы с первого запроса.
        - queryQ3 - Скидки, которые были выданы клиентам, записанным на сегодняшние события.
        - queryQ4 - Деньги, перечисленные конторе за сегодняшний день.
        - queryQ5 - Дополнительные доходы
        - queryQ5 - Дополнительные расходы
        - queryQ5 - Дополнительные техпомощь
    
     */
    
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

        $queryQ5 = Yii::$app->db->createCommand("
            SELECT sum, descriptions
            FROM payments_crm
            WHERE created_at BETWEEN '".date('Y-m-d 00:00:00')."' AND '$time' AND type = 4
        ")->queryAll();

        $queryQ6 = Yii::$app->db->createCommand("
            SELECT sum, descriptions
            FROM payments_crm
            WHERE created_at BETWEEN '".date('Y-m-d 00:00:00')."' AND '$time' AND type = 5
        ")->queryAll();

        $queryQ7 = Yii::$app->db->createCommand("
            SELECT sum(sum)
            FROM payments_crm
            WHERE created_at BETWEEN '".date('Y-m-d 00:00:00')."' AND '$time' AND type = 1
        ")->queryScalar();

        $queryQ8_1 = Yii::$app->db->createCommand("
            SELECT sum(sum)
            FROM payments_dinner
            WHERE created_at BETWEEN '".date('Y-m-d 00:00:00')."' AND '$time'
        ")->queryScalar();

        $queryQ8_2 = Yii::$app->db->createCommand("
            SELECT sum(s1.value) 
            FROM (
                SELECT es.id_service, cc.value, es.id_consultant, es.consultant_end
                FROM events_services es
                LEFT JOIN consultants_cost cc ON cc.id_service = es.id_service AND cc.id_consultant_type = (
                    SELECT id_type FROM consultants WHERE id_user = es.id_consultant)  
            ) s1
            WHERE s1.consultant_end > :d_past AND s1.consultant_end < :d_future
        ")->bindValues([
            ':d_past' => date('Y-m-d'),
            ':d_future' => (new \DateTime('tomorrow'))->format('Y-m-d'),
        ])->queryScalar();

        // $queryQ9 = Yii::$app->db->createCommand("
        //     SELECT type, sum(sum) as sum
        //     FROM paids
        //     WHERE date > '".date('Y-m-d 00:00:00')."' and type is not null
        //     GROUP BY type
        // ")->indexBy('type')->queryAll();

        $queryQ9 = (new \yii\db\Query())
            ->select(['type', 'sum(sum) as sum'])
            ->from('paids')
            ->where(["and", [">", "date", date('Y-m-d 00:00:00')], ["not", ["type" => null]]])
            ->groupBy('type')
            ->indexBy('type')
            ->all();
        
        return $this->render('daily-report', [
            'queryQ1' => $queryQ1,
            'queryQ2' => $queryQ2,
            'queryQ3' => $queryQ3,
            'queryQ4' => $queryQ4,
            'queryQ5' => $queryQ5,
            'queryQ6' => $queryQ6,
            'queryQ7' => $queryQ7,
            'queryQ8' => $queryQ8_1 + $queryQ8_2,
            'queryQ9' => $queryQ9,
        ]);
    }
    
}
