<?php

namespace app\modules\directories\controllers;

use yii\web\Controller;

/**
 * Default controller for the `Directory` module
 */
class DefaultController extends \app\modules\directories\components\web\Controller
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
