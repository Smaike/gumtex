<?php
use yii\helpers\Url;
/**
 * @var \understeam\calendar\CalendarWidget $context
 * @var \yii\web\View $this
 * @var \understeam\calendar\ItemInterface $item
 * @var \understeam\calendar\GridCell $cell
 */

$context = $this->context;
$currentMonth = $context->isInPeriod($cell->date);
$isActive = $context->isActive($cell->date);
$time = $cell->date->format('Y-m-d');
$link = ($isActive)? Url::to(['calendar/index', 'date' => $time, 'viewMode' => 'day']) : "";
?>
<div class="calendar-month-cell">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= $cell->date->format('d') ?>
        </div>
        <a href = "<?=$link?>" style="text-decoration: none; color: inherit;">
        <div class="panel-body<?=$isActive ? ' active' : '' ?> <?=(in_array($cell->date->format('N'), [6,7])) ? 'closed' : ''?>">
            <span style="font-size: 12px;">Л|У</span><br>
            <?= count($cell->items) ?>|<?= $cell->countServices() ?>
        </div>
        </a>
    </div>
</div>
