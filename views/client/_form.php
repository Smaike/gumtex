<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->radioList(['М' => 'М', 'Ж' => 'Ж']) ?>

    <?= $form->field($model, 'age') ?>

    <?= $form->field($model, 'birthday', ['template' => "{label}<br />{input}\n{hint}\n{error}"])->widget(DatePicker::className(),[
        'dateFormat' => 'dd-MM-yyyy',
        'clientOptions' => [
            'changeMonth' => true,
            'yearRange' => '1930:2016',
            'changeYear' => true,
            'showOn' => 'button',
            'buttonImage' => Url::base().'/images/calendar.png',
            'buttonImageOnly' => true,
            'defaultDate' => '01-01-2000'
        ]])->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '99-99-9999',
                'options'=>[
                    'class' => 'form-control form_contact',
                    'style' => "width:80%; display:inline-block; margin-right:10px;",
                    'placeholder' => '31-12-1999'
    ]]) ?>

    <?= $form->field($model, 'birthday')->textInput() ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p_mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'category')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'where_know')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'fio_mother')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fio_father')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fio_sup')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
