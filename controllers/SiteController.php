<?php

namespace app\controllers;

use app\models\RegForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\forms\LoginForm;
// use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SendEmailForm;
use app\models\ResetPasswordForm;
use yii\web\JsExpression;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionReg()
    {
        $model = new RegForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate())
            if ($user = $model->reg()) {
                if ($user->is_active === User::STATUS_ACTIVE)
                    if (Yii::$app->getUser()->login($user))
                        return $this->goHome();

               /* if ($model->sendActivationEmail($user)) {
                    Yii::$app->session->setFlash('success', 'Письмо с активацией отправлено на емайл <strong>' . Html::encode($user->email) . '</strong> (проверьте папку спам).');

                } else {

                    Yii::$app->session->setFlash('error', 'Ошибка. Письмо не отправлено.');
                    Yii::error('Ошибка отправки письма.');
                }*/
                return $this->refresh();
            } else {
                die('owibka pri registracii');
                /*Yii::$app->session->setFlash('error','Возникла проблема при регистрации');
                        Yii::error('Ошибка при регистрации');
                        return $this->refresh();*/
            }

        return $this->render(
            'reg',
            [
                'model' => $model
            ]
        );
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSendEmail()
    {
        $model = new SendEmailForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->sendEmail()):
                    Yii::$app->getSession()->setFlash('warning', 'Проверьте емайл.');
                    return $this->goHome();
                else:
                    Yii::$app->getSession()->setFlash('error', 'Нельзя сбросить пароль.');
                endif;
            }
        }
        return $this->render('send-email', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($key = '')
    {
        /*try {
            $model = new ResetPasswordForm($key);
        }
        catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }*/
        $key = $_GET['key'];
        $model = new ResetPasswordForm($key);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->resetPassword()) {
                Yii::$app->getSession()->setFlash('warning', 'Пароль изменен.');
                return $this->redirect(['/site/login']);
            }
        }
        return $this->render('reset-password', [
            'model' => $model,
        ]);
    }
}
