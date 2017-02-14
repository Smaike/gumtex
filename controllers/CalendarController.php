<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use understeam\calendar\CalendarActionForm;
use yii\web\JsExpression;
use app\models\ActiveDay;

class CalendarController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
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
}
