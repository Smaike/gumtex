<?php 
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>
<?php if(!empty($models)){?>
<?=Html::radioList('EventCreateForm[copy_id]', null, ArrayHelper::map($models, 'id', 'dataForCopiesField'), ['itemOptions' => ['class' => 'radio-inline radio-select-copy'], 'separator' => '<br>', 'encode' => false])?>
<?php }else{?>
Нет результатов
<?php }?>