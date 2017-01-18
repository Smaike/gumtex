<?php
namespace app\models;

use Yii;
use yii\base\Model;

class SendEmailForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => User::className(),
                'filter' => [
                    'is_active' => User::STATUS_ACTIVE
                ],
                'message' => 'Данный емайл не зарегистрирован.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Емайл'
        ];
    }

    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne(
            [
                'is_active' => User::STATUS_ACTIVE,
                'email' => $this->email
            ]
        );

        if($user) {
            $user->generateSecretKey();
//            var_dump($user->save());
//            print_r($user->getErrors());

            if($user->save()) {
                return Yii::$app->mailer->compose('reset-password', ['user' => $user])
                    ->setFrom(['from@from.fr' => Yii::$app->name.' '])
                    ->setTo($this->email)
                    ->setSubject('Сброс пароля для '.$user->login)
                    ->send();
            }
        }

        return false;
    }

}