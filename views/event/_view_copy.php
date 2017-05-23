<?php 
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>
<?=$model->last_name?><br>
<?=$model->first_name?><br>
<?=$model->middle_name?><br>
<?=$model->age?><br>
<?=$model->birthday?><br>
<?=$model->mobile?><br>
<button class="btn btn-primary" data-dismiss="modal" onClick="$('input[name=\'EventCreateForm[copy_id]\'][value=\'<?=$model->id?>\']').trigger('click')">Выбрать</button>
<button class="btn btn-danger" data-dismiss="modal">Закрыть</button>