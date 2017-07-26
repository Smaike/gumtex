<?php 
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
$serv = ($model->lastEvent)?$model->lastEvent->getServices()->one():"";
?>
<b><?=$model->last_name?> <?=$model->first_name?> <?=$model->middle_name?></b><br>
<?=$model->age?> лет <?=$model->birthday?> тел. <?=$model->mobile?><br>
Email: <?=$model->email?><br>
мать: <?=$model->fio_mother?> лет <?=$model->birthday?> тел. <?=$model->p_mobile?><br>
отец: <?=$model->fio_father?> лет <?=$model->birthday?> тел. <?=$model->p_mobile?><br>
Дата оказания последней услуги: <?=($model->lastEvent)?$model->lastEvent->date:""?><br>
Вид услуги: <?=(!empty($serv))?$serv->name:""?><br>
<button class="btn btn-primary" data-dismiss="modal" onClick="$('input[name=\'EventCreateForm[copy_id]\'][value=\'<?=$model->id?>\']').trigger('click')">Выбрать</button>
<button class="btn btn-danger" data-dismiss="modal">Закрыть</button>