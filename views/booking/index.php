<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Бронирование';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column){
                    return Html::a("Просмотр", Url::to(['booking/index', 'room' => $model->id]), ['class' => 'btn btn-primary']);
                    
                }
            ]
        ],
    ]); ?>
</div>
