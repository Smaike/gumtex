<?php

use yii\helpers\Html;

/**
 * @var \app\components\web\View $this
 * @var string $content
 */
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>


<div class="row">
	<div class="col-sm-2">
		<?php $stat = Yii::$app->user->identity->consultantStatistic()  ?>
			<div class="panel panel-default">
				<div class="panel-heading">Услуг оказано: <?=$stat['count']?></div>
				<div class="panel-heading">На сумму: <?=$stat['sum']?></div>
				
			</div>
	</div>

	<div class="col-sm-10">
		<?= $content ?>
	</div>
</div>

<?php $this->endContent(); ?>
