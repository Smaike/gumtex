<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Service;
use yii\helpers\ArrayHelper;
use dosamigos\datetimepicker\DateTimePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\search\ClientSearch */
/* @var $form yii\widgets\ActiveForm */

$models = Service::find()->all();
$services = ArrayHelper::map($models, 'id', 'name');
?>

<div class="client-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'first_name') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'last_name') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'service')->dropDownList($services, ['prompt' => 'Выберите услугу']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'time_start')->widget(DateTimePicker::className(), [
                'language' => 'ru',
                'size' => 'ms',
                'template' => '{input}',
                'pickButtonIcon' => 'glyphicon glyphicon-time',
                // 'inline' => true,
                'clientOptions' => [
                    'startView' => 3,
                    'minView' => 1,
                    'maxView' => 4,
                    'autoclose' => true,
                    // 'linkFormat' => 'yyyy-mm-dd HH:ii', // if inline = true
                    'format' => 'yyyy-mm-dd HH:00', // if inline = false
                    'todayBtn' => true
                ]
            ]);?>
        </div>
        <div class="col-sm-3">
        <?= $form->field($model, 'time_end')->widget(DateTimePicker::className(), [
                'language' => 'ru',
                'size' => 'ms',
                'template' => '{input}',
                'pickButtonIcon' => 'glyphicon glyphicon-time',
                // 'inline' => true,
                'clientOptions' => [
                    'startView' => 3,
                    'minView' => 1,
                    'maxView' => 4,
                    'autoclose' => true,
                    // 'linkFormat' => 'yyyy-mm-dd HH:00', // if inline = true
                    'format' => 'yyyy-mm-dd HH:00', // if inline = false
                    'todayBtn' => true
                ]
            ]);?>
        </div>
    </div>
    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'p_mobile') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'id_consultant') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'where_know') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'fio_mother') ?>

    <?php // echo $form->field($model, 'fio_father') ?>

    <?php // echo $form->field($model, 'fio_sup') ?>

    <?php // echo $form->field($model, 's_mobile') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <div class="form-group">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сбросить', Url::to('/client'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>