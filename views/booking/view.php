<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\web\View;
use yii\data\ActiveDataProvider;
use app\models\EventsService;

use app\models\Service;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = $model->client->first_name . " " . $model->client->last_name;
$this->params['breadcrumbs'][] = ['label' => 'События', 'url' => ['calendar/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php /* Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите его удалить?',
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'date',
            'client.first_name',
            'client.last_name',
            'client.middle_name',
            'client.birthday',
            'client.mobile',
            [
                'attribute' => "client.p_first_name",
                'visible' => $model->client->getAge()<18,
            ],
            [
                'attribute' => "client.p_last_name",
                'visible' => $model->client->getAge()<18,
            ],
            [
                'attribute' => "client.p_middle_name",
                'visible' => $model->client->getAge()<18,
            ],[
                'attribute' => "client.p_mobile",
                'visible' => $model->client->getAge()<18,
            ],
            'client.clientType.name',
            'client.clientCategory.name',
        ],
    ]) ?>
    <div class="col-sm-6">
        <h2>Услуги</h2>
        <table class="table table-bordered table-striped">
        <?php foreach($model->services as $service){
            if($es = EventsService::find()->where([
                'id_service' => $service->id,
                'id_event' => $model->id,
                'status' => 'new',
            ])->one()){?>
                <tr>
                    <td><?=$service->name?></td>
                    <td><?php Modal::begin([
                        'header' => '<h2>Выберите аудиторию</h2>',
                        'toggleButton' => [
                            'label' => 'Начать',
                            'class' => "btn btn-success start-serv",
                            'data-service' => $service->id,
                            'data-event' => $model->id,
                        ],
                    ]);?>
                    <?php Modal::end();?>
                        
                    </td>
                </tr>
            <?php }
        }?>
        </table>
    </div>
    

</div>
<?php $this->registerJs("
    $(document).on('click', '.start-serv', function(){
        var div = $(this);
        console.log(div);
        $.ajax({
          url: '" . Url::to('directory/computer/list-activity', true) . "',
          type: 'POST',   
          data: {'service':div.data('service'), 'event':div.data('event')}, 
          success: function(response){
            $('.modal-body').html(response);
          }
        });
    });",
    View::POS_END,
     'my-options');
?>
