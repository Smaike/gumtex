<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ActiveDay */

$this->title = 'Изменить день: ' . $model->date;
$this->params['breadcrumbs'][] = ['label' => 'Активный день', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->date, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="active-day-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
