<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use understeam\calendar\CalendarActionForm;
use yii\web\JsExpression;

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
        if (!$model->validate()) {
            // Reset form to default values
            $model = new CalendarActionForm($calendar);
            $model->validate();
        }
        $grid = $model->getGrid();
        $viewFile = '@vendor/understeam/yii2-calendar-widget/src/views/calendar';

        $options = [
             'onClick' => new JsExpression("function(d,t){alert([d,t].join(' '))}"),
        ];

        return $this->render($viewFile, [
            'usePjax' => true,
            'widgetOptions' => [
                'grid' => $model->getGrid(),
                'viewMode' => $model->viewMode,
                'period' => $model->getPeriod(),
                'calendar' => $calendar,
                'clientOptions' => $options,
            ],
        ]);
    }
}
