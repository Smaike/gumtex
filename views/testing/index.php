<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать</h1>

        <p class="lead">Вы начали <?=$eventsService->idService->name?></p>
        <iframe src="<?=$url?>&width=800&height=800" style="width:100%; border:none; height:800px"></iframe>
    </div>
</div>
