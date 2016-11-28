<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserType */

$this->title = 'Изменить тип пользователя: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Типы пользователей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="user-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
