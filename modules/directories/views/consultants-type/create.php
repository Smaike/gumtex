<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\directories\models\ConsultantsType */

$this->title = 'Добавить тип консультантов';
$this->params['breadcrumbs'][] = ['label' => 'Типы консультантов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consultants-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
