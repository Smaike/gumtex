<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegForm */
/* @var $form ActiveForm */
?>
<div class="reg">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'login') ?>
        <?= $form->field($model, 'password') ?>
        <?= $form->field($model, 'password2') ?>
        <?= $form->field($model, 'first_name') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'last_name') ?>
        <?= $form->field($model, 'middle_name') ?>

        <?//= $form->field($model, 'status') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- reg -->
