<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

use app\models\User;

$this->title = 'Список консультантов';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="consultant-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить консультанта', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'user.fullName',
                'label' => 'Пользователь'
            ],
            [
                'attribute' => 'cat.name',
                'label' => 'Категория'
            ],
            [
                'attribute' => 'type.name',
                'label' => 'Тип'
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
