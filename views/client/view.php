<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Client */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'first_name',
            'last_name',
            'middle_name',
            'birthday',
            'mobile',
            'p_mobile',
            'type',
            'category',
            'id_consultant',
            'comment:ntext',
            'where_know:ntext',
            'age',
            'fio_mother',
            'fio_father',
            'fio_sup',
            's_mobile',
            'gender',
        ],
    ]) ?>

</div>
