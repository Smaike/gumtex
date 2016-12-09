<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClientType */

$this->title = 'Создать тип клиентов';
$this->params['breadcrumbs'][] = ['label' => 'Типы клиентов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
