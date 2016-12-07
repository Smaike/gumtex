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
?>
<div class="col-sm-1">
    <div>
        <div class="panel-body<?=$isActive ? ' active' : '' ?>" data-cal-date="<?=$time ?>" style="cursor:pointer">
            <?= $cell->date->format('H:i') ?>
        </div>
    </div>
</div>
<div class="col-sm-11">
    <div>
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
    </div>
</div>
