<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EmailsHistory */

$this->title = Yii::t('app', 'Create Emails History');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Emails Histories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emails-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
