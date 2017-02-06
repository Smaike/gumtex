<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

use app\models\ClientCategory;
use app\models\ClientType;
use app\models\Service;

$models = ClientCategory::find()->all();
$categories = $models;
// $categories = ArrayHelper::map($models, 'id', 'name');
$models = ClientType::find()->all();
$types = $models;
$models = Service::find()->all();
$services = ArrayHelper::map($models, 'id', 'name');

?>

<div class="price-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id_service')->dropDownList($services, ['prompt' => 'Выберите услугу']) ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'date_start', ['template' => "{label}<br />{input}\n{hint}\n{error}"])->widget(DatePicker::className(),[
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'yearRange' => '2017:2020',
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
            <?= $form->field($model, 'price', ['inputOptions' => [
                'class' => 'form-control ch_price'
                ]
            ])->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <?php /*
        <div class="col-sm-6">
            <?= $form->field($model, 'discount', ['inputOptions' => [
                'disabled' => ($model->client_category_id || $model->client_type_id)? false:true,
                'class' => 'form-control ch_price'
                ]
            ])->textInput() ?>
        </div>
        */?>
    </div>
    <h2>Скидки</h2>
    <div class="row">
        <div class="col-sm-6">
            <?php foreach ($categories as $key => $category) {?>
                <?=Html::label($category->name)?>
                <?=Html::input('text', 'category[' . $category->id . ']', $model->getDiscountCategory($category->id), ['class' => 'form-control']) ?>
            <?php }?>
        </div>
        <div class="col-sm-6">
            <?php foreach ($types as $key => $type) {?>
                <?=Html::label($type->name)?>
                <?=Html::input('text', 'type[' . $type->id . ']', $model->getDiscountType($type->id), ['class' => 'form-control']) ?>
            <?php }?>
        </div>
        <?php /*
        <div class="col-sm-6">
            <?= $form->field($model, 'client_type_id', ['inputOptions' => [
                'class' =>'ch_disc form-control ch_price'
                ]
            ])->dropDownList($types, ['prompt' => 'Выберите Тип']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'client_category_id', ['inputOptions' => [
                'class' =>'ch_disc form-control ch_price'
                ]
            ])->dropDownList($categories, ['prompt' => 'Выберите Категорию']) ?>
        </div>
        */?>
    </div>
    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>