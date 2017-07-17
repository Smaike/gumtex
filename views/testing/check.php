<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form ActiveForm */
?>
<div class="wrap">
    <div class="container">
        <div class="testing-check">
        <div class="col-sm-6 col-sm-offset-3">

        <h1>Проверьте Ваши данные</h1>
            <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'last_name') ?>
                <?= $form->field($model, 'first_name') ?>
                <?= $form->field($model, 'middle_name') ?>
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
                
                <?= $form->field($model, 'grade') ?>
                <?= $form->field($model, 'hobby') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'mobile') ?>
                <?= $form->field($model, 'fio_mother') ?>
                <?= $form->field($model, 'fio_father') ?>
                <?= $form->field($model, 'fio_sup') ?>
                <?= $form->field($model, 'p_mobile') ?>
            
                <div class="form-group">
                    <?= Html::submitButton('Начать тест', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
        </div><!-- testing-check -->
    </div>
</div>
