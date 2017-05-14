<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Компьютеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="computer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить компьютер', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'ip',
            // 'is_processed',
            // 'is_processed_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
