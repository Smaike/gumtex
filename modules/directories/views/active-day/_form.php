<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ActiveDay */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="active-day-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    	<div class="col-sm-12">
    		<?= $form->field($model, 'date', ['template' => "{label}<br />{input}\n{hint}\n{error}"])->widget(DatePicker::className(),[
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'yearRange' => '2017:2090',
                    'changeYear' => true,
                    'showOn' => 'button',
                    'buttonImage' => Url::base().'/images/calendar.png',
                    'buttonImageOnly' => true,
                ]])->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '9999-99-99',
                        'options'=>[
                            'class' => 'form-control form_contact',
                            'style' => "width:80%; display:inline-block; margin-right:10px;",
                            'placeholder' => '1999-12-31'
            ]]) ?>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-6">
		    <?= $form->field($model, 'split')->dropDownList([
		    	15 => '15 минут',
		    	30 => '30 минут',
		    	45 => '45 минут',
		    	60 => '60 минут',
		    ], ['prompt' => '']) ?>
		</div>
		<div class="col-sm-6">
    		<?= $form->field($model, 'is_active', ['options' => ['style' => 'margin-top: 30px']])->checkbox() ?>
    	</div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
