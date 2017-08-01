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
<meta http-equiv="refresh" content="30" />
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
                    if(in_array($model->status, ["consultant", "new", "processed", "consultant_progress"])){
                        return (!empty($model->consultant))?"Консультирует " . $model->consultant->fullName:null;
                    }else{
                        return (!empty($model->consultant))?"Консультировался у " . $model->consultant->fullName:null;
                    }
                }
            ],
            [
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column){
                    if(!empty($model->url_report)){
                        return Html::a("Результат", Url::to(['/consultant/pdf-report', 'id' => $model->id]), ['class' => 'btn btn-primary', 'target' => '_blank']);
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
