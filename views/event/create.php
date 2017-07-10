<?php

use yii\bootstrap\Modal;
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
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-sm-offset-1">
                <h2>Вы заполняете событие на <?=$model->date?></h2>
            </div>
        </div>
        <div class="row">
            <div class='col-sm-5 col-sm-offset-1'>
            
            <?= $form->field($model, 'last_name', ['inputOptions' => [
                'class' =>'form-control find-copies'
                ]
            ]) ?>
            <?= $form->field($model, 'first_name', ['inputOptions' => [
                'class' =>'form-control find-copies'
                ]
            ]) ?>
            <?= $form->field($model, 'middle_name', ['inputOptions' => [
                'class' =>'form-control find-copies'
                ]
            ]) ?>
            <?= $form->field($model, 'gender')->radioList(['М' => 'М', 'Ж' => 'Ж']) ?>
            <?= $form->field($model, 'age', ['inputOptions' => [
                'class' =>'form-control find-copies'
                ]
            ]) ?>
            <?= $form->field($model, 'fio_sup') ?>
            <?= $form->field($model, 'mobile') ?>
            <?= $form->field($model, 's_mobile') ?>
            <?= $form->field($model, 'category', ['inputOptions' => [
                'class' =>'form-control'
                ]
            ])->dropDownList($categories, ['prompt' => 'Выберите Категорию']) ?>
            <?= $form->field($model, 'type', ['inputOptions' => [
                'class' =>'form-control'
                ]
            ])->dropDownList($types, ['prompt' => 'Выберите Тип']) ?>
            <?= $form->field($model, 'id_consultant')->dropDownList($consultants, ['prompt' => 'Выберите консультанта']) ?>
            <?= $form->field($model, 'comment')->textarea([
                'rows' => 8, 
                'class' => 'form-control', 
                'placeholder' => 'Добавить комментарий',
            ]) ?>
            <?= $form->field($model, 'where_know')->dropDownList([
                1 => "Интернет",
                2 => "Реклама",
                3 => "От друзей",
                4 => "Нашел сам"
            ], ['prompt' => 'Откуда узнал']) ?>
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
            <?= $form->field($model, 'fio_mother') ?>
            <?= $form->field($model, 'fio_father') ?>
            <?= $form->field($model, 'p_mobile') ?>
            <?= $form->field($model, 'date', ['template' => '{input}'])->hiddenInput() ?>
        
            </div>
            <div class='col-sm-5'>
                <div class="row">
                    <div class='col-sm-12'>
                        <?php foreach ($aServices as $key => $services){
                            Modal::begin([
                                'header' => '<h2>Услуги</h2>',
                                'toggleButton' => [
                                    'label' => $key,
                                    'class' => "btn btn-success start-serv",
                                    'style' => 'margin-top:25px'
                                ],
                            ]);?> 
                            <?= Html::checkboxList('services[]', $model->services, $services, ['separator' => "<br>"])?>
                            <?php Modal::end();?>
                        <?php }?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class='col-sm-6'>
                        <label class="control-label">Стоимость:</label>
                        <?= $form->field($model, 'price')->label(false) ?>
                        <label class="control-label">Скидка:</label>
                        <?= $form->field($model, 'discount')->label(false) ?>
                        <?= $form->field($model, 'why', ['options' => ['style' => (!empty($model->why))?'':'display:none']])->textarea(['rows' => 4])->label("Почему:") ?>
                    </div>
                </div>
                <hr>
                <h4>Уже есть в базе:</h4>
                <img id="LoadingImage" src = "<?=Url::base(true)?>/images/loading.gif" width="30" style="display:none">
                <div class="clones">
                Нет результатов
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-offset-1 col-sm-11">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
    <?php Modal::begin([
        'header' => '<h2>Карточка клиента</h2>',
        'options' => ['id' => 'modal-info']
    ]);?> 
</div><!-- event-create -->

<?php $this->registerJs("
    $('input[name=\"services[]\"]').change(function(){
        var data = { 'user_ids[]' : []};
        $('input[name=\"services[]\"]:checked').each(function() {
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

    $('#eventcreateform-discount').on('keyup', function(){
        var skidka = $(this).val();
        if(skidka!=''){
            $('.field-eventcreateform-why').css({'display':'block'});
        }else{
            $('.field-eventcreateform-why').css({'display':'none'});
        }
    });

    $('.find-copies').on('change', function(){
        $('#LoadingImage').show();
        $.ajax({
          url: '" . Url::to('event/copies', true) . "',
          type: 'POST',   
          data: {
            'last':$('#eventcreateform-last_name').val(), 
            'first':$('#eventcreateform-first_name').val(), 
            'middle':$('#eventcreateform-middle_name').val(),
            'age':$('#eventcreateform-age').val(),
          }, 
          success: function(response){
            $('#LoadingImage').hide();
            $('.clones').html(response);
          }
        });
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

    $(document).on('click', '.show_copy', function(){
        $('#modal-info').modal('show');
        $.ajax({
          url: '" . Url::to('event/view-copy', true) . "',
          type: 'GET',   
          data: {'id':$(this).data('id')}, 
          success: function(response){
            $('#modal-info>.modal-dialog>.modal-content>.modal-body').html(response);
          }
        });
    });

    $(document).on('click', '.radio-select-copy', function(){
        $.ajax({
          url: '" . Url::to('event/fill-client', true) . "',
          type: 'GET',   
          data: {'id':$(this).val()}, 
          success: function(response){
            var arr = $.parseJSON(response);
            $.each(arr, function(i, item ) {
              if(i == 'gender'){
                $('input[name=\'EventCreateForm[gender]\'][value=' + item + ']').attr('checked', 'checked');
              }else{
                $('#eventcreateform-'+i).val(item);
              }
            });
          }
        });
    });

",
    View::POS_END,
     'my-options');
?>