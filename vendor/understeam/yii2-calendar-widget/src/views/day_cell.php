<?php
use yii\helpers\Url;
use yii\web\View;
use yii\bootstrap\Modal;
/**
 * @var \understeam\calendar\CalendarWidget $context
 * @var \yii\web\View $this
 * @var \understeam\calendar\ItemInterface $item
 * @var \understeam\calendar\GridCell $cell
 */

$context = $this->context;
$isActive = $context->isActive($cell->date);
$time = $cell->date->format('Y-m-d H:i');
$linkProfile = Url::to();
?>
<?php /*
<div class="col-sm-1">
    <div>
        <div class="panel-body<?=$isActive ? ' active' : '' ?>" data-cal-date="<?=$time ?>" style="cursor:pointer">
            <?= $cell->date->format('H:i') ?>
        </div>
    </div>
</div>
        */?>
<div  >
    <div>
        <?php /*
        <div class="panel-body" data-cal-date="<?=$time ?>">
            <?php foreach($cell->items as $item){?>
                <div class="row" style="width:100%; border-bottom: 1px dotted black">
                    <div class="col-sm-4"><?=$item->client->last_name?> <?=$item->client->first_name?> <?=$item->client->middle_name?></div>
                    <div class="col-sm-1"><?=$item->client->age?></div>
                    <div class="col-sm-2"><?php foreach ($item->services as $service) {?>
                        <?= $service->name?><br>
                    <?php }?></div>
                    <div class="col-sm-2"><?=$item->client->id_consultant?></div>
                    <div class="col-sm-3"><?=$item->client->comment?></div>
                </div>
            <?php }?>
            <?php if(count(($cell->items < 6))&&($isActive)){?> 
            <div class="row">
                <div class="panel-body<?=$isActive ? ' active' : '' ?>" style="width: 150px; cursor:pointer" >
                    <a href = "<?=Url::to(['event/create', 'date' => $time])?>" style="text-decoration: none; color: inherit; font-size: 18px;">+</a>
                    
                </div>
            </div>
            <?php }?>
        </div>
        */?>
        <table class=" day_cell table panel-body table-bordered" data-cal-date="<?=$time?>" style = "margin-bottom: 0px; border:none">

            <?php if($count === 1){?>
            <tr>
                <th >Время</th>
                <th style="width:25%">ФИО клиента</th>
                <th style="width:5%">Возр.</th>
                <th style="width:15%">Услуги</th>
                <th style="width:15%">Консультант</th>
                <th style="width:19%">Комментарии</th>
                <th style="width:10%">Оплачено/Сумма</th>
                <th style="width:4%">#</th>
            <tr>
            <?php }?>
            <?php $count=0?>
            <?php foreach($cell->items as $item){
                $count++;?>
                <tr>
                    <?php if($count==1){?><td rowspan="7" style="cursor:pointer; width:7%"><?= $cell->date->format('H:i') ?></td><?php }?>
                    <td style="width:25%"><?=$item->client->last_name?> <?=$item->client->first_name?> <?=$item->client->middle_name?></td>
                    <td style="width:5%"><?=$item->client->age?></td>
                    <td style="width:15%">
                        <table class="table table-bordered table-striped">
                            <?php foreach ($item->services as $service) {?>
                            <tr>
                                <td><?=$service->name?></td>
                                <td><?php Modal::begin([
                                    'header' => '<h2>Код для начала тестирования</h2>',
                                    'toggleButton' => [
                                        'label' => 'Начать',
                                        'class' => "btn btn-success start-serv",
                                        'data-service' => $service->id,
                                        'data-event' => $item->id,
                                    ],
                                ]);?>
                                <?php Modal::end();?>
                                    
                                </td>
                            </tr>
                            <?php }?>
                        </table>
                    </td>
                    <td style="width:15%"><?=$item->client->consultantName?></td>
                    <td style="width:19%"><?=$item->client->comment?></td>
                    <td style="width:10%">
                        <?=(int)$item->sum_paid?>/<?=$item->price-$item->discount?><br>
                        <?php if((int)$item->sum_paid != $item->price-$item->discount){?>
                            <input type="text" class="form-control" id="paid-<?=$item->id?>">
                            <button class="btn btn-info button-paid" data-id="<?=$item->id?>" style="margin-top: 10px;">Оплатить</button>
                        <?php }?>
                    </td>
                    <td style="width:4%">
                        <a href = "<?=Url::to(['event/view', 'id' => $item->id])?>" data-pjax = '0'>
                            <ico class="glyphicon glyphicon-search" style="font-size: 12px"></ico>
                        </a>
                        <a href = "<?=Url::to(['event/update', 'id' => $item->id])?>" data-pjax = '0'>
                            <ico class="glyphicon glyphicon-pencil" style="font-size: 12px"></ico>
                        </a>
                        <a href = "<?=Url::to(['event/separate', 'id' => $item->id])?>" >
                            <ico class="glyphicon glyphicon-sort" style="font-size: 12px"></ico>
                        </a>

                        <a href = "<?=Url::to(['event/delete', 'id' => $item->id])?>" >
                            <ico class="glyphicon glyphicon-remove" style="font-size: 12px"></ico>
                        </a>
                    </td>
                </tr>
            <?php }?>
            <?php if(count($cell->items) < 6){?> 
            <tr>
                <?php if(count($cell->items) == 0){?>
                    <td style="cursor:pointer; width:7%"><?= $cell->date->format('H:i') ?></td>
                <?php }?>
                <td colspan="7" class="panel-body<?=$isActive ? ' active' : '' ?>" style="width:93% cursor:pointer; line-height: 42px; height: 42px;" >
                    <?php if($isActive){?>
                        <a href = "<?=Url::to(['event/create', 'date' => $time])?>" style="text-decoration: none; color: inherit; font-size: 18px;" data-pjax = '0'><div style="width:100%">+</div></a>
                        <?php if($separate){?>
                            <a href = "<?=Url::to(['event/bind', 'date' => $time])?>" style="text-decoration: none; color: inherit; font-size: 18px;" data-pjax = '0'><div class="separate" style="width:100%">+</div></a>
                        <?php }?>
                    <?php }?>
                </td>
            </tr>
            <?php }?>
        </table>
    </div>
</div>
<?php $this->registerJs("
    $('.button-paid').click(function(){
        $.ajax({
            url: '" . Url::to('event/paid', true) . "',
            type: 'POST',   
            data: {
                'id':this.dataset.id,
                'sum':$('#paid-'+this.dataset.id).val(),
            }, 
            success: function(response){
                location.reload();
            }
        });
    });
    $(document).on('click', '.start-serv', function(){
        var div = $(this);
        $.ajax({
          url: '" . Url::to('event/create-code', true) . "',
          type: 'POST',   
          data: {'service':div.data('service'), 'event':div.data('event')}, 
          success: function(response){
            $('.modal-body').html(response);
          }
        });
    });

",
    View::POS_END,
     'my-options');
?>