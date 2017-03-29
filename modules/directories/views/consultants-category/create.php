<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\directories\models\ConsultantsCategory */

$this->title = 'Создание категории консультанта';
$this->params['breadcrumbs'][] = ['label' => 'Категории консультанотов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consultants-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
