<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EmailsTpls */

$this->title = Yii::t('app', 'Create Emails Tpls');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Emails Tpls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emails-tpls-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
