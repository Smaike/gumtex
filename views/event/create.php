<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\web\View;

use app\models\User;

$models = User::find()->where(['type' => 1])->select(['id', 'first_name', 'last_name'])->all();
$consultants = ArrayHelper::map($models, 'id', 'fullName');
?>
<div class="event-create row">
    <h2>Вы заполняете событие на <?=$model->date?></h2>
        <div class="row">
            <div class='col-sm-6'>
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'first_name') ?>
            <?= $form->field($model, 'last_name') ?>
            <?= $form->field($model, 'middle_name') ?>
            <?= $form->field($model, 'birthday', ['template' => "{label}<br />{input}\n{hint}\n{error}"])->widget(DatePicker::className(),[
                'dateFormat' => 'dd-MM-yyyy',
                'clientOptions' => [
                    'changeMonth' => true,
                    'yearRange' => '1907:2016',
                    'changeYear' => true,
                    'showOn' => 'button',
                    'buttonImage' => Url::base().'/images/calendar.png',
                    'buttonImageOnly' => true,
                ]])->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '99-99-9999',
                        'options'=>[
                            'class' => 'form-control form_contact',
                            'style' => "width:80%; display:inline-block; margin-right:10px;",
                            'placeholder' => '31-12-1999'
            ]]) ?>
            <?= $form->field($model, 'mobile') ?>
            <?= $form->field($model, 'type') ?>
            <?= $form->field($model, 'category') ?>
            <?= $form->field($model, 'id_consultant')->dropDownList($consultants, ['prompt' => '']) ?>
            <?= $form->field($model, 'comment') ?>
            <?= $form->field($model, 'where_know') ?>
            <?= $form->field($model, 'p_first_name') ?>
            <?= $form->field($model, 'p_last_name') ?>
            <?= $form->field($model, 'p_middle_name') ?>
            <?= $form->field($model, 'p_mobile') ?>
            <?= $form->field($model, 'date', ['template' => '{input}'])->hiddenInput() ?>
        
            </div>
            <div class='col-sm-6'>
                <?= $form->field($model, 'services')->checkboxList($aServices, ['separator' => "<br>"]) ?>
                <br><br>
                <h3>Стоимость:</h3>
                <span id="cost" style="font-size: 18px;">0</span>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
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
          data: {'services':data['user_ids[]']}, 
          success: function(response){
            $('#cost').html(response);
          }
        });
    });",
    View::POS_END,
     'my-options');
?>