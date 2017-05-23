<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поиск по коду';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consultant-serarch">

    <?php $form = ActiveForm::begin(); ?>
    <?php if (Yii::$app->session->hasFlash('searchError')){?>
        <p class="text-danger">Код не найден</p>
    <?php }?>
    <div class="row">
        <div class="col-sm-3">
            <?=Html::input('text', 'code', '', ['class' => 'form-control'])?>
        </div>
        <div class="col-sm-3">
            <?=Html::submitButton('Искать', ['class' => 'btn btn-primary'])?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
