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
$costs = 0;
$costs += $queryQ7 + $queryQ8;
?>
<style>
    @media print {
      .nav {
        display: none;
      }
      .breadcrumb{
        display: none;
      }
      #printPageButton {
        display: none;
      }
    }
</style>
<div class="event-index" id="report">
    <button id="printPageButton" onClick="window.print();">Печать</button>

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
    	<th colspan='3' align='right'><h2>Дополнительные расходы:</h2></th>
    </tr>
    <tr>
    	<th colspan="2">Причина</th>
    	<th>Сумма</th>
    </tr>
    <?php foreach($queryQ5 as $row){
    	$costs += $row['sum'];?>
    	<tr>
    		<td colspan="2">
    			<?=$row['descriptions']?>
    		</td>
    		<td>
    			<?=$row['sum']?>
    		</td>
    	</tr>
    <?php }?>

    <tr>
    	<th colspan='3' align='right'><h2>Дополнительные доходы:</h2></th>
    </tr>
    <tr>
    	<th colspan="2">Причина</th>
    	<th>Сумма</th>
    </tr>
    <?php foreach($queryQ6 as $row){?>
    	<tr>
    		<td colspan="2">
    			<?=$row['descriptions']?>
    		</td>
    		<td>
    			<?=$row['sum']?>
    		</td>
    	</tr>
    <?php }?>
	<tr>
    	<th colspan='3' align='right'><h2>Итог:</h2></th>
    </tr>
    <tr>
    	<td colspan='3' align='right'>Итог (по оказанным услугам): <?=$queryQ2?></td>
    </tr>
    <tr>
    	<td colspan='3' align='right'>Получено денежных средств от клиента сегодня: <?=$queryQ4?> из них:</td>
    </tr>
	<?php foreach($queryQ9 as $row){?>
    	<tr>
    		<td colspan="3" align='right'>
    			<?=\app\models\Paid::getTypes()[$row['type']]?>: <?=$row['sum']?>
    		</td>
    	</tr>
    <?php }?>
    <tr>
    	<td colspan='3' align='right' style="border-top:1px solid black">Итог скидок на сумму: <?=$discount?></td>
    </tr>
    <tr>
    	<td colspan='3' align='right'>Тех-помощь: <?=$queryQ7?></td>
    </tr>
    <tr>
    	<td colspan='3' align='right'>Выплачено консультантам (Обеды + оказанные услуги): <?=$queryQ8?></td>
    </tr>
    <tr>
    	<td colspan='3' align='right'>Расходы сегодня: <?=$costs?></td>
    </tr>
    <tr>
    	<td colspan='3' align='right'>В кассе: <?=((array_key_exists(1, $queryQ9))? $queryQ9[1]['sum']:0) - $costs?></td>
    </tr>


    </table>
    
</div>