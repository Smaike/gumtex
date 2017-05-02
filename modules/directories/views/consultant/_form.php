<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\User;
use app\modules\directories\models\ConsultantsCategory;
use app\modules\directories\models\ConsultantsType;

$consultants = ArrayHelper::map(
    User::find()->where(['is_active' => 1])->all(), 
    'id', 
    function($model, $defaultValue) {
        return $model['last_name'].' '.$model['first_name'];
    }
);
$cats = ArrayHelper::map(
    ConsultantsCategory::find()->all(), 
    'id', 
    'name'
);
$types = ArrayHelper::map(
    ConsultantsType::find()->all(), 
    'id', 
    'name'
);
?>

<div class="consultant-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($model->isNewRecord){?>
    	<?= $form->field($model, 'id_user')->dropDownList($consultants, ['prompt' => 'Выберите пользователя'])?>
    <?php }else{?>
    	<?= $form->field($model, 'id_user', ['options' => ['style' => 'display:none']])->hiddenInput()?>
    <?php }?>
    <?= $form->field($model, 'id_category')->dropDownList($cats, ['prompt' => 'Выберите категорию'])?>

    <?= $form->field($model, 'id_type')->dropDownList($types, ['prompt' => 'Выберите тип'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Править', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
