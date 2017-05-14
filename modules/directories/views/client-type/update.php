<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClientType */

$this->title = 'Изменить тип скидок: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Типы скидок', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="client-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
