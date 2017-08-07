<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\ActiveForm;

use app\models\PaymentCrm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Расходы';
$this->params['breadcrumbs'][] = ['label' => 'Платежи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(PaymentCrm::getTypesList()) ?>

    <?= $form->field($model, 'descriptions', [
    	'inputOptions' => [
        	'class' =>'form-control',
        	'style' => 'display:none;',
        	'placeholder' => 'Причина'
        ]
    ])->label(false)->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?php $this->registerJs("
    $(document).on('change', '#paymentcrm-type', function(){
        if($(this).val() == 4){
        	$('#paymentcrm-descriptions').css({'display':'block'});
        }else{
        	$('#paymentcrm-descriptions').css({'display':'none'});
        }
    });

",
    View::POS_END,
     'my-options');
?>