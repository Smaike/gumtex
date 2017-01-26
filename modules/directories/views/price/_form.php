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
$categories = ArrayHelper::map($models, 'id', 'name');
$models = ClientType::find()->all();
$types = ArrayHelper::map($models, 'id', 'name');
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
                    'yearRange' => '1907:2016',
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
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'price', ['inputOptions' => [
                'class' => 'form-control ch_price'
                ]
            ])->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'discount', ['inputOptions' => [
                'disabled' => ($model->client_category_id || $model->client_type_id)? false:true,
                'class' => 'form-control ch_price'
                ]
            ])->textInput() ?>
        </div>
    </div>
    <div class="row">
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
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= Html::label('', null, ['id' => 'total', 'class' => 'control-label']);?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJs("
    var is_dis;
    if($('#price-discount').val() != ''){
        is_dis = true;
    }else{
        is_dis=false;
    }
    var price = 0;
    $('.ch_disc').change(function(){
        $.each($('.ch_disc'), function(key, value){
            if($(value).val()!=''){
                $('#price-discount').removeClass('disabled');
                $('#price-discount').prop('disabled', false);
                is_dis = true;
                return false;
            }
            $('#price-discount').addClass('disabled');
            $('#price-discount').prop('disabled', true);
            is_dis = false;
        });
    });
    $('.ch_price').on('keyup change', function(){
        if($('#price-discount').val() > 100){
            $('#price-discount').val(100);
        }else if($('#price-discount').val() < 0){
            $('#price-discount').val(0);
        }
        price = $('#price-price').val();
        if(is_dis){
            price = price - price * ($('#price-discount').val()/100);
        }
        $('#total').text('Итого: '+price);
    });",
    View::POS_END,
     'my-options');
?>