<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\ServiceTime */

$this->title = 'Выберите категорию услуг';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-time-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach($types as $type){?>
    	<?=Html::a($type->name, Url::to(['index', 'type_id' => $type->id]), ['class' => 'btn btn-success'])?><br><br>
    <?php }?>

</div>
