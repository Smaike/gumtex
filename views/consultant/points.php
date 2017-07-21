<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

use app\models\Paid;
use app\models\Receipt;
use app\models\Service;

/* @var $this yii\web\View */
/* @var $model app\models\Client */

$this->title = "Баллы";
?>
<div class="consultant-points">
    <h2>Рекомендованные тренинги:</h2>
    <?php foreach($models as $model){?>
        <h3><?=$model->service->name?> для <?=$model->es->idEvent->client->fullName?></h3>
    <?php }?>
</div>