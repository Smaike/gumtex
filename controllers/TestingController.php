<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\models\Event;
use app\models\Service;
use app\models\Computer;
use app\models\EventsService;

/**
 * EventController implements the CRUD actions for Event model.
 */
class TestingController extends Controller
{
    private $soapClient;

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

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        $options = [
            "login" => "",
            "password" => "",
        ];
        $wsdlpath = Yii::getAlias("@app")."/htline.wsdl"; 

        $SoapClient = new \SoapClient($wsdlpath,$options);
        $this->soapClient = $SoapClient;    
        return true; // or false to not run the action
    }

    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        $soap = $this->soapClient;
        var_dump($soap->getTestName(2)['TestName']);
        die;
        $computer = Computer::find(1)->one();
        $eventsService = EventsService::find($computer->is_processed_by)->one();
        return $this->render('index', [
            'eventsService' => $eventsService,
        ]);
    }
}
