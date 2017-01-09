<?php

namespace app\modules\emails\controllers;

use app\modules\emails\components\Controller;

/**
 * Default controller for the `directories` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
