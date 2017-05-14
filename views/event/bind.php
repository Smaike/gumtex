<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

	<h2>Выберите клиента, которого перенести на это время</h2>
    <?php $form = ActiveForm::begin(); ?>

    <?php foreach ($models as $model) {?>
	    <div class="form-group">
	        <?= Html::submitButton($model->client->fullName, [
	        	'class' => 'btn btn-primary',
	        	'value' => $model->id, 
	        	'name' => 'id',
	        ]) ?>
	    </div>
    <?php }?>


    <?php ActiveForm::end(); ?>

</div>
