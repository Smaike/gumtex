<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Computer */

$this->title = 'Добавить компьютер';
$this->params['breadcrumbs'][] = ['label' => 'Компьютеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="computer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
