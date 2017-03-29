<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\Service;


$services = Service::find()->andWhere(['status' => 1])->all();

/* @var $this yii\web\View */
/* @var $model app\modules\directories\models\ConsultantsType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consultants-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <h2>Стоимости</h2>
    <div class="row">
	    <div class="col-sm-6">
		    <?php foreach ($services as $key => $service) {?>
		        <?=Html::label($service->name)?>
		        <?=Html::input('text', 'service[' . $service->id . ']', $model->getCostService($service->id), ['class' => 'form-control']) ?>
		    <?php }?>
	    </div>
	</div>
    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
