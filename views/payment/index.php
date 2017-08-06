<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Платежи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <a href="<?=Url::to(['/payment/dinner'])?>" class="btn btn-primary">Обеды</a>
    <a href="<?=Url::to(['/payment/expenses'])?>" class="btn btn-primary">Расходы</a>
    <a href="<?=Url::to(['/payment/dinner'])?>" class="btn btn-primary">Доходы</a>
    
</div>
