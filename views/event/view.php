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
            'client.clientType.name',
            'client.clientCategory.name',
        ],
    ]) ?>
    <div class="col-sm-6">
        <h2>Услуги</h2>
        <table class="table table-bordered table-striped">
        <?php foreach($model->eS as $service){?>
            
            <tr>
                <td><?=$service->idService->name?></td>
                <td><?php if(($model->howmanyPaid() >= $model->howmanyCost()) && empty($service->code)){
                     Modal::begin([
                        'header' => '<h2>Код для начала тестирования</h2>',
                        'toggleButton' => [
                            'label' => 'Начать',
                            'class' => "btn btn-success start-serv",
                            'data-id' => $service->id,
                        ],
                    ]);
                     Modal::end();
                }{ echo "Не оплачено";}?>
                    
                </td>
            </tr>
        <?php }?>
        </table>
    </div>
    

</div>
<?php $this->registerJs("
    $(document).on('click', '.start-serv', function(){
        var div = $(this);
        $.ajax({
          url: '" . Url::to('event/create-code', true) . "',
          type: 'POST',   
          data: {event':div.data('id')}, 
          success: function(response){
            $('.modal-body').html(response);
            location.reload();
          }
        });
    });",
    View::POS_END,
     'my-options');
?>
