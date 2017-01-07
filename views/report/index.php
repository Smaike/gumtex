<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отчеты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'idEvent.client.fullName',
                'label' => 'Имя',
            ],
            [
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column){
                    return Html::a("Отчет", Url::to(['testing/report', 'id' => $model->id]), ['class' => 'btn btn-primary']);
                    
                }
            ]
        ],
    ]); ?>
</div>
