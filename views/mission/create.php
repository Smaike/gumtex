<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Mission */
/* @var $form ActiveForm */
?>
<div class="mission-create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'description') ?>
        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'id_created') ?>
        <?= $form->field($model, 'is_report') ?>
        <?= $form->field($model, 'updated_by') ?>
        <?= $form->field($model, 'created_at') ?>
        <?= $form->field($model, 'updated_at') ?>
        <?= $form->field($model, 'theme') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- mission-create -->
