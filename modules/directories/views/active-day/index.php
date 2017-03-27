<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Активные дни';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-day-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($proforientationDays, 'monday')->checkbox()?>
            <?= $form->field($proforientationDays, 'tuesday')->checkbox()?>
            <?= $form->field($proforientationDays, 'wednesday')->checkbox()?>
            <?= $form->field($proforientationDays, 'thursday')->checkbox()?>
            <?= $form->field($proforientationDays, 'friday')->checkbox()?>
            <?= $form->field($proforientationDays, 'saturday')->checkbox()?>
            <?= $form->field($proforientationDays, 'sunday')->checkbox()?>

            <?= $form->field($proforientationDays, 'start', [
                'inputOptions' => [
                    'class' => 'form-control'
                ]])->textInput()->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => '99:99',
                    'options'=>[
                        'class' => 'form-control form_contact',
                        'placeholder' => '10:00'
                ]]) ?>

            <?= $form->field($proforientationDays, 'end', [
                'inputOptions' => [
                    'class' => 'form-control'
                ]])->textInput()->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => '99:99',
                    'options'=>[
                        'class' => 'form-control form_contact',
                        'placeholder' => '19:00'
                ]]) ?>

        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <p>
        <?= Html::a('Добавить день', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'date',
            'split',
            'is_active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
