<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать</h1>
        <h2>Введите код</h2>
        <?=Html::beginForm('testing', 'post')?>
	        <?=Html::input('text', 'code')?>
	        <?=Html::submitButton('Ввести')?>
        <?=Html::endForm()?>
	    <div cass="row">
	        <p style="color:orange; font-size:18px; margin-top:20px;"><?php if($msg = Yii::$app->session->getFlash('warning')) { echo $msg; }  ?></p>
	    </div>
    </div>
</div>
