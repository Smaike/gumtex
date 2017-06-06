<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'В работе';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'idEvent.client.fio',
                'label' => 'ФИО'
            ],
            [
                'attribute' => 'statusLabel',
                'label' => 'Статус'
            ],
            [
                'attribute' => 'code',
                'label' => 'Код',
            ],
            [
                'attribute' => 'code_generated',
                'label' => 'Время создания кода',
            ],
            [
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column){
                    if(empty($model->idEvent->client->consultant) && in_array($model->status, ["consultant", "new", "processed"])){
                        return Html::a("Консультировать", Url::to([
                            'consultant/take', 
                            'id' => $model->id
                        ]), ['class' => 'btn btn-primary']);
                    }elseif($model->status == 'consultant_progress'){
                        if(!empty($model->idEvent->client->consultant) && $model->idEvent->client->consultant->id == Yii::$app->user->id){
                            return Html::a("Завершить", Url::to([
                                'consultant/finish', 
                                'id' => $model->id
                            ]), ['class' => 'btn btn-primary']);
                        }else{
                            return (!empty($model->idEvent->client->consultant))?"Консультирует " . $model->idEvent->client->consultant->fullName:null;
                        }
                    }else{
                        return null;
                    }
                }
            ],
            [
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column){
                    if(!empty($model->url_report)){
                        return Html::a("Отчет", Url::to([
                            'testing/report', 
                            'id' => $model->id
                        ]), ['class' => 'btn btn-primary', 'target' => '_blank']);
                    }
                }
            ]
        ],
        'rowOptions' => function ($model, $index, $widget, $grid){
            return ['style'=> $model->getInWorkColor()];
        },
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
    ]); ?>
</div>
