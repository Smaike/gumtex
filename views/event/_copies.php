<?php 
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>
<?php if(!empty($models)){?>
<?=Html::radioList('EventCreateForm[copy_id]', null, ArrayHelper::map($models, 'id', 'fullName'), ['itemOptions' => ['class' => 'radio-inline'], 'separator' => '<br>'])?>
<?php }else{?>
Нет результатов
<?php }?>