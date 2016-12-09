<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClientCategory */

$this->title = 'Создать категорию клиентов';
$this->params['breadcrumbs'][] = ['label' => 'Категории клиентов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
