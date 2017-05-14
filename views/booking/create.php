<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use yii\widgets\ActiveForm;
use yii\jui\DateTimePicker;
use yii\web\View;

?>
<div class="event-create row">
    <h2>Вы заполняете событие на <?=$model->date_start?></h2>
        <div class="row">
            <div class='col-sm-6'>
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'date_end', ['template' => "{label}<br />{input}\n{hint}\n{error}"])->widget(DateTimePicker::className(),[
                'dateFormat' => 'dd-MM-yyyy H:i',
                'clientOptions' => [
                    'changeMonth' => true,
                    'yearRange' => '1907:2016',
                    'changeYear' => true,
                    'showOn' => 'button',
                    'buttonImage' => Url::base().'/images/calendar.png',
                    'buttonImageOnly' => true,
                ]])->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '99-99-9999',
                        'options'=>[
                            'class' => 'form-control form_contact',
                            'style' => "width:80%; display:inline-block; margin-right:10px;",
                            'placeholder' => '31-12-1999'
            ]]) ?>
            
            <?= $form->field($model, 'date_start', ['template' => '{input}'])->hiddenInput() ?>
            <?= $form->field($model, 'room_id', ['template' => '{input}'])->hiddenInput() ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- event-create -->