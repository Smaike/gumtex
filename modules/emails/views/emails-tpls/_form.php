<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use skeeks\yii2\ckeditor\CKEditorWidget;
use skeeks\yii2\ckeditor\CKEditorPresets;

/* @var $this yii\web\View */
/* @var $model app\models\EmailsTpls */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emails-tpls-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'content')->widget(CKEditorWidget::className(), [
        'preset' => CKEditorPresets::BASIC
    ]) ?>

    <?/*= $form->field($model, 'date_add')->textInput() ?>

    <?= $form->field($model, 'date_send')->textInput() ?>

    <?= $form->field($model, 'date_update')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
