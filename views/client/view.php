<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\web\View;

use app\models\Paid;

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
    <div class="row">
        <div class="col-sm-6">
            <h2>События</h2>
            <table class="table table-bordered table-striped">
            <tr>
                <th>Дата</th>
                <th>Услуги</th>
                <th>Оплачено</th>
                <th>Оплата</th>
            </tr>
            <?php foreach($model->events as $event){?>
                <tr>
                <td><?=$event->date?></td>
                    <td>
                    <?php foreach ($event->services as $service) {?>
                        <?=$service->name?><br>
                    <?php }?>
                    </td>
                    <td>
                        <?=$event->howmanyPaid()?>/<?=$event->howmanyCost()?>
                    </td>
                    <td>
                        <?php if($event->howmanyPaid() < $event->howmanyCost()){?>
                            <?php Modal::begin([
                                'header' => '<h2>Оплата события от ' . $event->date . '</h2>',
                                'toggleButton' => [
                                    'label' => 'Оплатить',
                                    'class' => "btn btn-success",
                                ],
                            ]);?>
                            <form id="form_paid_<?=$event->id?>">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="control-label">Тип:</label>
                                    <?=Html::radioList('type_paid_' . $event->id, 1, Paid::getTypes(), ['separator' => '<br>'])?>
                                </div>
                                <div class="col-sm-4">
                                    <label class="control-label">Сумма:</label>
                                    <?=Html::input('text', 'sum_paid' . $event->id, null, ['class' => 'form-control', 'id' => 'sum_' . $event->id])?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?=Html::button('Готово!', [
                                        'class' => 'btn paid',
                                        'data-id' => $event->id,
                                        'style' => 'margin-top:10px;'
                                    ])?>
                                </div>
                            </div>
                            </form>
                            <?php Modal::end();?>
                            <?php }else{?>
                            Оплачено
                        <?php }?>
                    </td>
                </tr>
            <?php }?>
            </table>
        </div>
    </div>

</div>
<?php $this->registerJs("
    $('.paid').click(function(){
        $.ajax({
            url: '" . Url::to('client/paid', true) . "',
            type: 'POST',   
            data: {
                'id':this.dataset.id,
                'sum':$('#sum_'+this.dataset.id).val(),
                'type': $('input[name=type_paid_'+this.dataset.id+']:checked', '#form_paid_'+this.dataset.id).val(),
            }, 
            success: function(response){
                alert('Успешно');
                location.reload();
            }
        });
    });

",
    View::POS_END,
     'my-options');
?>