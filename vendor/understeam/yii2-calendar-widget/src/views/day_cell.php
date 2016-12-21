<?php
use yii\helpers\Url;
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
            <tr>
                <th style="width:10%">Время</th>
                <th style="width:25%">ФИО клиента</th>
                <th style="width:5%">Возраст</th>
                <th style="width:15%">Услуги</th>
                <th style="width:15%">Консультант</th>
                <th style="width:19%">Комментарии</th>
                <th style="width:1%">#</th>
            <tr>
            <?php $count=0?>
            <?php foreach($cell->items as $item){
                $count++;?>
                <tr>
                    <?php if($count==1){?><td rowspan="7" style="cursor:pointer"><?= $cell->date->format('H:i') ?></td><?php }?>
                    <td><?=$item->client->last_name?> <?=$item->client->first_name?> <?=$item->client->middle_name?></td>
                    <td><?=$item->client->age?></td>
                    <td><?php foreach ($item->services as $service) {?>
                        <?= $service->name?><br>
                    <?php }?></td>
                    <td><?=$item->client->id_consultant?></td>
                    <td><?=$item->client->comment?></td>
                    <td>
                        <a href = "<?=Url::to(['event/view', 'id' => $item->id])?>"">
                            <ico class="glyphicon glyphicon-search" style="font-size: 12px"></ico>
                        </a>
                    </td>
                </tr>
            <?php }?>
            <?php if(count(($cell->items) < 6)){?> 
            <tr>
                <?php if(count($cell->items) == 0){?>
                    <td style="cursor:pointer"><?= $cell->date->format('H:i') ?></td>
                <?php }?>
                <td colspan="6" class="panel-body<?=$isActive ? ' active' : '' ?>" style="width: 150px; cursor:pointer; line-height: 42px; height: 42px;" >
                    <?php if($isActive){?>
                        <a href = "<?=Url::to(['event/create', 'date' => $time])?>" style="text-decoration: none; color: inherit; font-size: 18px;"><div style="width:100%">+</div></a>
                    <?php }?>
                </td>
            </tr>
            <?php }?>
        </table>
    </div>
</div>
