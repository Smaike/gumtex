<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Сброс пароля';
$this->params['breadcrumbs'][] = $this->title;

?>
<? /*
 <div cass="row">
        <p style="color:green; font-size:18px; margin-top:20px;"><? if ($msg = Yii::$app->session->getFlash('success')) { echo $msg; }  ?></p>
    </div>
    <div cass="row">
        <p style="color:orange; font-size:18px; margin-top:20px;"><? if ($msg = Yii::$app->session->getFlash('warning')) { echo $msg; }  ?></p>
    </div>
 */ ?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div><!-- login1 -->
