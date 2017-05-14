<?php

namespace app\modules\emails\controllers;

use app\models\EmailsHistory;
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

    public function actionSend() {
        $emails = EmailsSend::findAll(['is_send' => '!=1']);
        if (empty($emails))
            die('nothing to do');
        $se = 0;
        foreach ($emails as &$e)
        {
            $emailsend = unserialize($e->recipients);
            if (!empty($emailsend))
                foreach($emailsend as $es)
                {
                    $se++;
                    $user = User::find()->where(['id'=>$es])->one();
                    if (!empty($user))
                        \Yii::$app->mailer->compose('sendings', ['content' => $e->content])
                            ->setFrom(['from@from.fr' => \Yii::$app->name.''])
                            ->setTo($user->email)
                            ->setSubject($e->subject)
                            ->send();
                    else $status = false;

                    $eh = new EmailsHistory();
                    $eh->emails_send_id = $e->id;
                    $eh->recipient = !empty($user) ? $user->id : '';
                    $eh->date_send = date('Y-m-d h:i:s'); //дата отправки
                    $eh->user_id = $es;
                    $eh->save();
                }
            $e->date_send = date('Y-m-d h:i:s'); //дата отправки
            $e->is_send = 1;
            $e->save();
        }
        echo 'rassilok '.count($emails).PHP_EOL;
        echo 'send '.$se.PHP_EOL;
    }

}
