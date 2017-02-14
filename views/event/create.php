<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\web\View;

use app\models\ClientCategory;
use app\models\ClientType;
use app\models\User;

$models = User::find()->where(['type' => 1])->select(['id', 'first_name', 'last_name'])->all();
$consultants = ArrayHelper::map($models, 'id', 'fullName');

$models = ClientCategory::find()->all();
$categories = ArrayHelper::map($models, 'id', 'name');

$models = ClientType::find()->all();
$types = ArrayHelper::map($models, 'id', 'name');
?>
<div class="event-create row">
    <h2>Вы заполняете событие на <?=$model->date?></h2>
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class='col-sm-6'>
            
            <?= $form->field($model, 'first_name') ?>
            <?= $form->field($model, 'last_name') ?>
            <?= $form->field($model, 'middle_name') ?>
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
            <?= $form->field($model, 'age') ?>
            <?= $form->field($model, 'mobile') ?>
            <?= $form->field($model, 'type', ['inputOptions' => [
                'class' =>'form-control'
                ]
            ])->dropDownList($types, ['prompt' => 'Выберите Тип']) ?>
            <?= $form->field($model, 'category', ['inputOptions' => [
                'class' =>'form-control'
                ]
            ])->dropDownList($categories, ['prompt' => 'Выберите Категорию']) ?>
            <?= $form->field($model, 'id_consultant')->dropDownList($consultants, ['prompt' => '']) ?>
            <?= $form->field($model, 'comment')->textarea([
                'rows' => 8, 
                'class' => 'form-control', 
                'placeholder' => 'Добавить комментарий',
            ]) ?>
            <?= $form->field($model, 'where_know') ?>
            <?= $form->field($model, 'p_first_name') ?>
            <?= $form->field($model, 'p_last_name') ?>
            <?= $form->field($model, 'p_middle_name') ?>
            <?= $form->field($model, 'p_mobile') ?>
            <?= $form->field($model, 'date', ['template' => '{input}'])->hiddenInput() ?>
        
            </div>
            <div class='col-sm-2'>
                <?= $form->field($model, 'services')->checkboxList($aServices, ['separator' => "<br>"]) ?>
                <br><br>
                <h3>Стоимость:</h3>
                <?= $form->field($model, 'price') ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- event-create -->
<?php $this->registerJs("
    $('input[name=\"EventCreateForm[services][]\"]').change(function(){
        var data = { 'user_ids[]' : []};
        $('input[name=\"EventCreateForm[services][]\"]:checked').each(function() {
          data['user_ids[]'].push($(this).val());
        });
        $.ajax({
          url: '" . Url::to('event/cost', true) . "',
          type: 'POST',   
          data: {
            'services':data['user_ids[]'], 
            'type':$('#eventcreateform-type').val(), 
            'category':$('#eventcreateform-category').val(),
            'date':$('#eventcreateform-date').val(),
          }, 
          success: function(response){
            $('#eventcreateform-price').val(response);
          }
        });
    });
    $('#eventcreateform-birthday').on('change', function(){
        birthDate = $(this).val();
        if(birthDate!='')
            $('#eventcreateform-age').val(getAge(birthDate));
    });
    $('#eventcreateform-first_name').on('change', function(){
        var val = $(this).val();
        $(this).val(ucfirst(val));
    });
    $('#eventcreateform-last_name').on('change', function(){
        var val = $(this).val();
        $(this).val(ucfirst(val));
    });
    $('#eventcreateform-middle_name').on('change', function(){
        var val = $(this).val();
        $(this).val(ucfirst(val));
    });

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

    function ucfirst( str ) { 
        var f = str.charAt(0).toUpperCase();
        return f + str.substr(1, str.length-1);
    }
",
    View::POS_END,
     'my-options');
?>