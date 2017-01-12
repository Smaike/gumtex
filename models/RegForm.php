<?php

namespace app\models;

use yii\base\Model;
use Yii;

class RegForm extends Model
{
    public $login;

    public $first_name;
    public $last_name;
    public $middle_name;
    public $email;
    public $password;
    public $password2;
    public $status;
    public $rights;
  //  public $reCaptcha;

    public function rules()
    {
        return [
            [['login','password','password2','first_name','email','last_name','middle_name'],'filter','filter'=>'trim'],
            [['login','email','password','fio','password2'],'required'],
            ['email','email'],
            [['password' ,'password2'], 'string', 'min'=>6, 'max' => 255],
            ['password2', 'compare', 'compareAttribute'=>'password','message'=>'Пароли должны совпадать'],
            ['login','unique',
                'targetClass' => User::className(),
                'message' => 'Логин уже занят'],
            ['email','unique',
                'targetClass' => User::className(),
                'message' => 'Email уже занят'],
            ['status','default','value' => User::STATUS_NOT_ACTIVE,'on' => 'default'],
          //  ['rights','default','value' => 'user','on' => 'default'],
            ['status','in','range' =>[
                User::STATUS_ACTIVE,
                User::STATUS_DELETED,
                User::STATUS_NOT_ACTIVE
            ]],
           // [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' =>'6LexzCMTAAAAAFXgIdCix4RA7zn0AK2UKpbL3eiz' ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'password2' => 'Повторите пароль',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'email' => 'E-mail',
        ];
    }

    public function reg() {
        $user = new User();

        $user->login = $this->login;
        $user->email = $this->email;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->middle_name = $this->middle_name;
        $user->created_at = date('Y-m-d h:i:s');
        $user->updated_at = date('Y-m-d h:i:s');
        $user->setPassword($this->password);
        $user->generateAuthKey();
//        $user->generateSecretKey();
        return $user->save() ? $user : null;
    }

    public function sendActivationEmail($user)
    {
        return Yii::$app->mailer->compose('activationEmail', ['user' => $user])
            ->setFrom(['from@from.fr' => Yii::$app->name.''])
            ->setTo($this->email)
            ->setSubject('Активация для '.$this->ls)
            ->send();
    }
}