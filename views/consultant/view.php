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

$this->title = "Код: ".$model->code;
?>
<div class="consultant-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <h2>Информаци о клиенте</h2>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'client.last_name',
            'client.first_name',
            'client.middle_name',
            'client.age',
            // 'client.gender',
            'client.grade',
            'client.hobby',
            // 'client.fio_sup',
            // 'client.mobile',
            // 'client.s_mobile',
            // 'client.clientType.name',
            // 'client.clientCategory.name',
            // 'client.birthday',
            // 'client.where_know:ntext',
            // 'client.comment:ntext',
            // 'client.fio_mother',
            // 'client.fio_father',
            // 'client.p_mobile',
        ],
    ]) ?>
    <h2>Информаци об услуге</h2>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'service.name',
            [
                'label' => 'Текущий статус',
                'attribute' => 'statusLabel',
            ],
            'code_generated',
            [
                'attribute' => 'allOtherEsNames',
                'label' => 'Другие услуги',
                'format' => 'raw',
            ]
        ],
    ]) ?>

    <h2>Действия</h2>
    <div class="row">
        <div class="col-sm-12">
            <?php if(in_array($model->status, ["consultant", "new", "processed"])){
                echo Html::a("Консультировать Все", Url::to([
                    'consultant/take-all', 
                    'id' => $model->id_event,
                    'es' => $model->id,
                ]), [
                    'class' => 'btn btn-primary', 
                    'style' => 'margin:10px 0'
                ]);
            }?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php if(in_array($model->status, ["consultant", "new", "processed"])){
                echo Html::a("Консультировать", Url::to([
                    'consultant/take', 
                    'id' => $model->id
                ]), ['class' => 'btn btn-primary']);
            }elseif($model->status == 'consultant_progress'){
                if(!empty($model->consultant) && $model->consultant->id == Yii::$app->user->id){
                    // уже ничего
                }else{
                    echo (!empty($model->consultant))?"Консультирует " . $model->consultant->fullName:null;
                }
            }else{
                echo null;
            }?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php if(!empty($model->url_report)){
                echo Html::a("Результат теста", $model->url_report, ['class' => 'btn btn-primary', 'target' => '_blank', 'style' => 'margin:10px 0']);
            }else{
                echo Html::a("Результат теста", '#', ['class' => 'btn btn-primary disabled', 'style' => 'margin:10px 0']);
            }?>
        </div>
    </div>
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-sm-6">
                <div class="btn btn-success" style="margin:10px 0" onclick="$('#tranings').toggle()">Рекомендации</div>
                <div id="tranings" style="display: none">
                <?php foreach (Service::getServicesList() as $key => $services){
                    Modal::begin([
                        'header' => '<h2>Услуги</h2>',
                        'toggleButton' => [
                            'label' => $key,
                            'class' => "btn btn-success start-serv",
                            'style' => 'margin-top:25px'
                        ],
                    ]);?> 
                    <?= Html::checkboxList('ConsultantEventForm[tranings]', $model->client->tranings, $services, ['separator' => "<br>"])?>
                    <?php Modal::end();?>
                <?php }?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php Modal::begin([
                    'header' => '<h2>Профессии</h2>',
                    'toggleButton' => [
                        'label' => 'Выбрать профессии',
                        'class' => "btn btn-success start-serv",
                        'style' => 'margin-bottom:25px; margin-top:15px;'
                    ],
                ]);?> 
                    <?= Html::checkboxList('ConsultantEventForm[professions]', $model->client->professions, $professions, ['separator' => "<br>"])?>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <?php Modal::end();?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?= Html::submitButton('Завершить все', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>