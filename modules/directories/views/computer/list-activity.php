<?php

use yii\helpers\Html;
use yii\widgets\DetailView;?>
<div class="row list-activity">
<?php foreach ($computers as $key => $computer) {?>

    <div class="col-sm-4 <?=($key%2 === 1)? 'col-sm-offset-4' : ''?>"><div class="pc <?= ($computer->is_processed)? 'active' : '' ?>">&nbsp;</div><?=$computer->name?></div>
<?php }?>
</div>