<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отчет на '.date('Y-m-d');
$this->params['breadcrumbs'][] = $this->title;
$discount = 0;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table">
    <tr>
    	<th colspan='3' align='right'><h2>Услуги:</h2></th>
    </tr>
    <tr>
    	<th>Услуга</th>
    	<th>Оказана раз</th>
    	<th>На сумму(по справочнику)</th>
    </tr>
    <?php foreach($queryQ1 as $row){?>
    	<tr>
    		<td>
    			<?=$row['name']?>
    		</td>
    		<td>
    			<?=$row['cnt']?>
    		</td>
    		<td>
    			<?=$row['sum']?>
    		</td>
    	</tr>
    <?php }?>
    <tr>
    	<td colspan='3' align='right'>Итог(фактически): <?=$queryQ2?></td>
    </tr>
    <tr>
    	<th colspan='3' align='right'><h2>Скидки:</h2></th>
    </tr>
    <tr>
    	<th>Кому</th>
    	<th>На какую сумму</th>
    	<th>Причина</th>
    </tr>
    <?php foreach($queryQ3 as $row){
    	$discount+=$row['discount'];?>
    	<tr>
    		<td>
    			<?=$row['lastname']?>
    		</td>
    		<td>
    			<?=$row['discount']?>
    		</td>
    		<td>
    			<?=$row['why']?>
    		</td>
    	</tr>
    <?php }?>
    <tr>
    	<td colspan='3' align='right'>Итог скидок на сумму: <?=$discount?></td>
    </tr>

    <tr>
    	<td colspan='3' align='right'>Получено денежных средств от клиента: <?=$queryQ4?></td>
    </tr>
    </table>
    
</div>