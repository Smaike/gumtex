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
$isClosed = ($context->isClosed($cell->date) || (empty($context->getDateRange($cell->date->format('w'))['start'])) && ($cell->date->format('Y-m-d') >= date('Y-m-d')));


$time = $cell->date->format('Y-m-d');
$link = ($isActive && !($isClosed))? Url::to(['calendar/index', 'date' => $time, 'viewMode' => 'day']) : "";
?>
<div class="calendar-month-cell">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= $cell->date->format('d') ?>
        </div>
        <a href = "<?=$link?>" style="text-decoration: none; color: inherit;">
        <div class="panel-body <?=($isClosed) ? 'closed' : ''?><?=($isActive) ? ' active' : '' ?>">
            <span style="font-size: 12px;">К|У</span><br>
            <?= count($cell->items) ?>|<?= $cell->countServices() ?>
        </div>
        </a>
    </div>
</div>
