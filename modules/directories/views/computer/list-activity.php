<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;?>
<div class="row list-activity">
<?php foreach ($computers as $key => $computer) {?>

    <div class="col-sm-4 <?=($key%2 === 1)? 'col-sm-offset-4' : ''?>">
    	<a href = "<?=Url::to(['/service/start', 'id' => $eventService->id, 'computer' => $computer->id])?>">
    	<div class="pc <?= ($computer->is_processed)? 'active' : '' ?>">&nbsp;</div>
    	<?=$computer->name?>
    	</a>
    </div>
<?php }?>
</div>