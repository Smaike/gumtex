<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\Mission */
/* @var $form ActiveForm */
?>
<div class="mission-create col-sm-6 col-sm-offset-3">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'theme') ?>
        <?= $form->field($model, 'is_report')->radioList([
            1 => 'да',
            0 => 'нет',
        ]) ?>
        <?= $form->field($model, 'description')->textarea(['rows' => 10]) ?>
        <?= $form->field($model, 'files[]')->widget(FileInput::classname(), [
            'options' => [
                'multiple' => true
            ],
            'pluginOptions' => [
                'maxFileCount' => 5
            ],
        ]); ?>
    
        <div class="form-group">
            <?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- mission-create -->
