<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\web\View;
use dosamigos\datetimepicker\DateTimePicker;

use app\models\Service;
use app\models\ActiveDay;

$models = Service::find()->where(['type_id' => $type_id, 'status' => 1])->all();
$services = ArrayHelper::map($models, 'id', 'name');
$disable_days = ActiveDay::find()->select(['date'])->where(['is_active' => 0])->column();
?>

<div class="service-time-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_service')->dropDownList($services, ['prompt' => 'Выберите услугу']) ?>
    <?php /*
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'date_start', ['template' => "{label}<br />{input}\n{hint}\n{error}"])->widget(DatePicker::className(),[
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'yearRange' => '1907:2016',
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
            ]])?>
        </div>
        <div class="col-sm-6">
        <?= $form->field($model, 'date_end', ['template' => "{label}<br />{input}\n{hint}\n{error}"])->widget(DatePicker::className(),[
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'yearRange' => '1907:2016',
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
        ]])?>
        </div>
    </div>
    */?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'time_start', ['inputOptions' => [
                'class' => 'form-control'
                ]
            ])->textInput()->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => '99:99',
                    'options'=>[
                        'class' => 'form-control form_contact',
                        'placeholder' => '12:00'
        ]]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'time_end', ['inputOptions' => [
                'class' => 'form-control'
                ]
            ])->textInput()->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => '99:99',
                    'options'=>[
                        'class' => 'form-control form_contact',
                        'placeholder' => '19:00'
        ]]) ?>
        </div>
    </div>
    <div class = "row">
        <div class="col-sm-6">
            <?= $form->field($model, 'dow', ['inputOptions' => [
                'class' => 'form-control'
                ]
            ])->checkboxList([
                1 => 'Понедельник',
                2 => 'Вторник',
                3 => 'Среда',
                4 => 'Четверг',
                5 => 'Пятница',
                6 => 'Суббота',
                0 => 'Воскресенье',
            ], ['separator' => "<br>"]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
                'events'=> $events,
                'dayRender' => "function(date, cell){
                    if ($.inArray(date.format('YYYY-MM-DD').toString(), ['" . implode("', '", $disable_days) . "']) !== -1){
                        $(cell).addClass('disabled');
                    }
                }",
                'eventRender' => "function(event, element, view){
                    return (event.ranges.filter(function(range){
                        return (event.start.isBefore(range.end) &&
                                event.end.isAfter(range.start) && 
                                ($.inArray(event.end.format('YYYY-MM-DD').toString(), ['" . implode("', '", $disable_days) . "']) == -1)
                        );
                    }).length)>0;
                }"
            ));?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
