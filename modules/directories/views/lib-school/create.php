<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LibSchool */

$this->title = 'Учебные заведения';
$this->params['breadcrumbs'][] = ['label' => 'Учебные заведения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lib-school-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
