<?php
/**
 * Created by:  Pavel Kondratenko
 * Created at:  22:14 09.04.14
 * Contact:     gustarus@gmail.com
 */

use yii\helpers\Html;

/**
 * @var \app\components\web\View $this
 * @var string $content
 */
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>


<div class="row">
	<div class="col-md-3 col-sm-4">
		<? foreach($this->context->menus as $menu) { ?>
			<div class="panel panel-default">
				<div class="panel-heading"><?= $menu['label'] ?></div>
				<div class="list-group">
					<? echo \yii\bootstrap\Nav::widget([
						'items' => $menu['items']
					]) ?>
				</div>
			</div>
		<? } ?>
	</div>

	<div class="col-md-9 col-sm-8">
		<?= $content ?>
	</div>
</div>

<?php $this->endContent(); ?>
