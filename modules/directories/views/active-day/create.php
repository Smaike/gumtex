<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ActiveDay */

$this->title = 'Create Active Day';
$this->params['breadcrumbs'][] = ['label' => 'Active Days', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-day-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
