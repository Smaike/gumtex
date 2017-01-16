<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Service;

use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use yii\web\View;


$models = Service::find()->all();
$services = ArrayHelper::map($models, 'id', 'name');
?>

<div class="service-time-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_service')->dropDownList($services, ['prompt' => 'Выберите услугу']) ?>

    <?= $form->field($model, 'date_start', ['template' => "{label}<br />{input}\n{hint}\n{error}"])->widget(DateTimePicker::className(),
    	[
        	'clientOptions' => [
        		'format' => 'yyyy-mm-dd hh:ii',
        		'startView' => 1,
		        'minView' => 0,
		        'autoclose' => true, // if inline = true
		        'todayBtn' => true,
		        'minuteStep' => 30,
    		]
    	]
    )?>

    <?= $form->field($model, 'date_end', ['template' => "{label}<br />{input}\n{hint}\n{error}"])->widget(DateTimePicker::className(),
    	[
        	'clientOptions' => [
        		'format' => 'yyyy-mm-dd hh:ii',
        		'startView' => 1,
		        'minView' => 0,
		        'autoclose' => true, // if inline = true
		        'todayBtn' => true,
		        'minuteStep' => 30,
    		]
    	]
    )?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
