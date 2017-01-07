<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\components\booking\CalendarActionForm;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;

use app\forms\BookingCreateForm;
use app\models\Booking;
use app\models\Room;
use app\models\search\RoomSearch;

class BookingController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $calendar = Yii::$app->get('booking_calendar');
        $calendar->room_id = Yii::$app->request->get('room');
        $model = new CalendarActionForm($calendar);
        $model->load(Yii::$app->request->getQueryParams());
        if (!$model->validate()) {
            // Reset form to default values
            $model = new CalendarActionForm($calendar);
            $model->validate();
        }
        $grid = $model->getGrid();
        $viewFile = '@app/components/booking/views/calendar';

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

    public function actionList()
    {
        $searchModel = new RoomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BookingCreateForm();
        $model->date_start = Yii::$app->request->get('date_start');
        $model->room_id = Yii::$app->request->get('room');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['booking/index', 'date' => date("Y-m-d",strtotime($model->date)), 'viewMode' => 'day', 'room' => $model->room_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Booking::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
