<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\UserType;
use yii\helpers\ArrayHelper;

$userTypes = UserType::find()->all();
$aUserTypes = ArrayHelper::map($userTypes, 'id', 'name');
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList($aUserTypes,['prompt' => 'Выберите тип']) ?>

    <?= $form->field($model, 'is_active')->radioList([
                        1 => 'Да',
                        0 => 'Нет',
                    ]) ?>

    <?= $form->field($model, 'is_notice')->radioList([
                        0 => 'Нет',
                        1 => 'Да',
                    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
