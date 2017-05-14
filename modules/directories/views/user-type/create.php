<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserType */

$this->title = 'Создать тип пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Типы пользователей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
