<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'last_name',
            'first_name',
            'middle_name',
            'birthday',
            'email',
            'mobile',
            // 'p_mobile',
            // 'type',
            // 'category',
            // 'id_consultant',
            // 'comment:ntext',
            // 'where_know:ntext',
            // 'age',
            // 'fio_mother',
            // 'fio_father',
            // 'fio_sup',
            // 's_mobile',
            // 'gender',

            [
                'class' => 'yii\grid\ActionColumn', 
                'template' => '{view}',
            ],
        ],
    ]); ?>
</div>
