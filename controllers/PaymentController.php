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
            ->where("created_at > '" . date('Y-m-d') . "' and created_at < '" . (new \DateTime('tomorrow'))->format('Y-m-d') . "'")]);
        $dp = new ActiveDataProvider([
            'query' => $consultants,
        ]);
        return $this->render('dinner', [
            'consultants' => $consultants->all(),
            'dp' => $dp,
        ]);
    }
}
