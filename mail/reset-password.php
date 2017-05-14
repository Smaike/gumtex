<?php

use yii\helpers\Html;
echo 'Здравствуйте '.Html::encode($user->login).'.  ';
echo Html::a('Для смены пароля перейдите по этой ссылке.',
    Yii::$app->urlManager->createAbsoluteUrl(
        [
            '/site/reset-password',
            'key' => $user->secret_key
        ]
    ));