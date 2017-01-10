<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EmailsTplsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Emails Tpls');
$this->params['breadcrumbs'][] = $this->title;

Yii::$app->timeZone = 'UTC';// ???
?>
<div class="emails-tpls-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Emails Tpls'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'content:raw',
            'date_add' =>
                [
                    'attribute' => 'date_add',
                    'format' =>  ['date', 'dd.MM.yyyy HH:mm']
                ],
            /*'date_send' =>
                [
                    'attribute' => 'date_send',
                    'format' =>  ['date', 'dd.MM.yyyy HH:mm']
                ],*/
            'date_update' =>
                [
                    'attribute' => 'date_update',
                    'format' =>  ['date', 'dd.MM.yyyy HH:mm']
                ],
             'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
