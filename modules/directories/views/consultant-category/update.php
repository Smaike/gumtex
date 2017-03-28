<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\directories\models\ConsultantsCategory */

$this->title = 'Update Consultants Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Consultants Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="consultants-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
