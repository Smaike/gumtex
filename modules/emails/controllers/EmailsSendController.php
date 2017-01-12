<?php

namespace app\modules\emails\controllers;

use app\models\EmailsTpls;
use app\modules\emails\components\Controller;

class EmailsSendController extends Controller
{
    public function actionIndex()
    {
        $tpls = EmailsTpls::find()->orderBy(['id' => SORT_DESC])->all();

        return $this->render('index',[
            'tpls' => $tpls,
        ]);
    }

    public function actionSelect() {
        \Yii::$app->response->format = 'json';
        $tpl = EmailsTpls::findOne(['id' => $_POST['newid']]);
        if (empty($tpl)) return ['status' => false, 'msg' => 'empty tpl'];
        $result = ['html' => $tpl->content, 'status' => true];
        return $result;
    }

    public function actionAdd() {
        \Yii::$app->response->format = 'json';
//        print_r($_POST); die();
        //TODO выбираем по email пользователей
        //Для каждого email сохраняем отдельную отправку в историю чтоб
        return ['status' => true];
    }

}
