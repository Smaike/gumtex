<?php

namespace app\modules\emails\controllers;

use app\modules\emails\components\Controller;

class EmailsSendController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
