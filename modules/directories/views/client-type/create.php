<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClientType */

$this->title = 'Создать тип скидок';
$this->params['breadcrumbs'][] = ['label' => 'Типы скидок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
