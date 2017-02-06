<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\ServiceType;

$ht_names = Yii::$app->soap->getHtNames();

$models = ServiceType::find()->all();
$types = ArrayHelper::map($models, 'id', 'name');
?>

<div class="service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->dropDownList($types, ['prompt' => 'Выберите тип услуги'])?>

    <?= $form->field($model, 'ht_name')->dropDownList($ht_names, ['prompt' => 'Выберите название из системы HT']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
