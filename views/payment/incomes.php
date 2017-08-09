<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\ActiveForm;

use app\models\PaymentCrm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Доходы';
$this->params['breadcrumbs'][] = ['label' => 'Платежи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descriptions', [
    	'inputOptions' => [
        	'class' =>'form-control',
        	'placeholder' => 'Причина'
        ]
    ])->label(false)->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>