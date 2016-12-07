<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LibSchool */

$this->title = 'Update Lib School: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lib Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lib-school-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
