<?php

namespace app\modules\emails\controllers;

use app\models\EmailsSend;
use app\models\EmailsTpls;
use app\models\User;
use app\modules\emails\components\Controller;

class EmailsSendController extends Controller
{
    public function actionIndex()
    {
        $tpls = EmailsTpls::find()->orderBy(['id' => SORT_DESC])->all();
        $users = User::find()->orderBy(['id' => SORT_DESC])->all();
        return $this->render('index',[
            'tpls' => $tpls,
            'users' => $users,
        ]);
    }

    public function actionSelect() {
        \Yii::$app->response->format = 'json';
        $tpl = EmailsTpls::findOne(['id' => $_POST['newid']]);
        if (empty($tpl)) return ['status' => false, 'msg' => 'empty tpl'];
        $result = ['html' => $tpl->content, 'subj' => $tpl->subject, 'status' => true];
        return $result;
    }

    public function actionAdd() {
        \Yii::$app->response->format = 'json';
        $users = serialize($_POST['emails']);
        $tpl = $_POST['newtpl'];
        $subject = $_POST['subject'];
        $parent_id = $_POST['parent_id'];
        $user_id = \Yii::$app->user->identity->id;
        $esend= new EmailsSend();
        $esend->is_send=0;
        $esend->content=$tpl;
        $esend->user_id=$user_id;
        $esend->subject=$subject;
        $esend->parent_id=$parent_id;
        $esend->recipients=$users;

        return ['status' => $esend->save()];
    }

}
