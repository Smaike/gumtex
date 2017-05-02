<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\directories\models\ConsultantsCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consultants-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_services')->checkboxList(call_user_func(array($model->className(), 'getListOfServices')), [
    	'separator' => '<br>'
    ]) ?>

	<div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Править', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
