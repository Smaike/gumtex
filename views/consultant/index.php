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

            'idEvent.client.fio',
            [
                'attribute' => 'computer.name',
                'label' => 'Номер компьютера',
            ],
            [
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column){
                    if($model->status == "consultant"){
                        return Html::a("Консультировать", Url::to([
                            'consultant/take', 
                            'id' => $model->id
                        ]), ['class' => 'btn btn-primary']);
                    }else{
                        if($model->idEvent->client->consultant->id == Yii::$app->user->id){
                            return Html::a("Завершить", Url::to([
                                'consultant/finish', 
                                'id' => $model->id
                            ]), ['class' => 'btn btn-primary']);
                        }else{
                            return "Консультирует " . $model->idEvent->client->consultant->fullName;
                        }
                    }
                }
            ]
        ],
    ]); ?>
</div>
