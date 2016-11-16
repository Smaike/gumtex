<?php
/**
 * @var \understeam\calendar\CalendarWidget $context
 * @var \yii\web\View $this
 * @var \understeam\calendar\ItemInterface $item
 * @var \understeam\calendar\GridCell $cell
 */

$context = $this->context;
$isActive = $context->isActive($cell->date);
?>
<div class="calendar-week-cell col-sm-2">
    <div>
        <div class="panel-body<?=$isActive ? ' active' : '' ?>" data-cal-date="<?=$cell->date->format('Y-m-d H:i') ?>">
            <?= $cell->date->format('H:i') ?>
        </div>
    </div>
</div>
<div class="calendar-week-cell col-sm-12">
    <div>
        <div class="panel-body" data-cal-date="<?=$cell->date->format('Y-m-d H:i') ?>">
            <?php foreach($cell->items as $item){?>
                <div class="row">
                    <div class="col-sm-3"><?=$item->date?></div>
                    <div class="col-sm-3"><?=$item->name?></div>
                    <div class="col-sm-3"><?=$item->status?>Лущиков Владислав Игоревич</div>
                    <div class="col-sm-3">Лущиков Владислав Игоревич</div>
                </div>
            <?php }?>
            <?php if(count(($cell->items < 6))&&($isActive)){?> 
            <div class="row">
                <div class="panel-body<?=$isActive ? ' active' : '' ?>" style="width: 200px;" data-cal-date="<?=$cell->date->format('Y-m-d H:i') ?>">Добавить</div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
