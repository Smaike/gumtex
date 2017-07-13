<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use understeam\calendar\CalendarActionForm;
use yii\web\JsExpression;
use yii\filters\AccessControl;

use app\models\ActiveDay;
use app\models\ServiceType;

class CalendarController extends Controller
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
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // if(!($type_id = Yii::$app->request->get('type_id')) && !($type_id = Yii::$app->session->get('type_id'))){
        //     return $this->redirect(['start']);
        // }else{
        //     if(!empty(Yii::$app->request->get('type_id'))){
        //         Yii::$app->session->set('type_id', Yii::$app->request->get('type_id'));
        //     }
        // }
        $calendar = Yii::$app->get('calendar');
        $model = new CalendarActionForm($calendar);
        $model->load(Yii::$app->request->getQueryParams());
        if(($db_model = ActiveDay::findOne(['date' => Yii::$app->request->get('date')])) && !empty($db_model->date)){
            $model->minute_period = $db_model->split;
        }
        $db_model = ActiveDay::findOne(['date' => Yii::$app->request->get('date')]);
        if (!$model->validate()) {
            // Reset form to default values
            $model = new CalendarActionForm($calendar);
            $model->validate();
        }
        $grid = $model->getGrid();
        $viewFile = '@vendor/understeam/yii2-calendar-widget/src/views/calendar';


        return $this->render($viewFile, [
            'usePjax' => true,
            'widgetOptions' => [
                'grid' => $model->getGrid(),
                'viewMode' => $model->viewMode,
                'period' => $model->getPeriod(),
                'calendar' => $calendar,
            ],
        ]);
    }

    // public function actionStart()
    // {
    //     $types = ServiceType::find()->all();
    //     return $this->render('@app/modules/directories/views/service-time/start', [
    //         'types' => $types,
    //     ]);
    // }
}
