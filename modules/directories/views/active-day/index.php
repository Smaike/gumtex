<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Активные дни';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-day-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить день', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'date',
            'split',
            'is_active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
