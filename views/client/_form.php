<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->radioList(['М' => 'М', 'Ж' => 'Ж']) ?>

    <?= $form->field($model, 'age') ?>

    <?= $form->field($model, 'birthday', ['template' => "{label}<br />{input}\n{hint}\n{error}"])->widget(DatePicker::className(),[
        'dateFormat' => 'dd-MM-yyyy',
        'clientOptions' => [
            'changeMonth' => true,
            'yearRange' => '1930:2016',
            'changeYear' => true,
            'showOn' => 'button',
            'buttonImage' => Url::base().'/images/calendar.png',
            'buttonImageOnly' => true,
            'defaultDate' => '01-01-2000'
        ]])->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '99-99-9999',
                'options'=>[
                    'class' => 'form-control form_contact',
                    'style' => "width:80%; display:inline-block; margin-right:10px;",
                    'placeholder' => '31-12-1999'
    ]]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'fio_sup') ?>
    <?= $form->field($model, 's_mobile') ?>
    <?= $form->field($model, 'fio_mother') ?>
    <?= $form->field($model, 'fio_father') ?>
    <?= $form->field($model, 'p_mobile') ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJs("
    $('#client-birthday').on('change', function(){
        birthDate = $(this).val();
        if(birthDate!='')
            $('#client-age').val(getAge(birthDate)).change();
    });
    $('#client-first_name').on('change', function(){
        var val = $(this).val();
        $(this).val(ucfirst(val.toLowerCase()));
    });
    $('#client-last_name').on('change', function(){
        var val = $(this).val();
        $(this).val(ucfirst(val.toLowerCase()));
    });
    $('#client-middle_name').on('change', function(){
        var val = $(this).val();
        $(this).val(ucfirst(val.toLowerCase()));
    });

    function ucfirst( str ) { 
        var f = str.charAt(0).toUpperCase();
        return f + str.substr(1, str.length-1);
    }

    function getAge(dateString) {
      var day = parseInt(dateString.substring(0,2));
      var month = parseInt(dateString.substring(3,5));
      var year = parseInt(dateString.substring(6,10));

      var today = new Date();
      var birthDate = new Date(year, month - 1, day); // 'month - 1' т.к. нумерация месяцев начинается с 0 
      var age = today.getFullYear() - birthDate.getFullYear();
      var m = today.getMonth() - birthDate.getMonth();
      if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) { 
          age--;
      }
      return age;
    }

",
    View::POS_END,
     'my-options');
?>