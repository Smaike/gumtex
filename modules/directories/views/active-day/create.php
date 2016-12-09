<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ActiveDay */

$this->title = 'Добавить день';
$this->params['breadcrumbs'][] = ['label' => 'День', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-day-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-sm-8">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>

</div>
