<?php
/**
 * @var array $grid
 * @var \understeam\calendar\CalendarWidget $context
 * @var \yii\web\View $this
 */
use understeam\calendar\CalendarHelper;
use app\models\DaysServices;

echo $this->render('header');
$context = $this->context;
$count = 0;
$dateRange = $context->getDateRange(date('w', strtotime(Yii::$app->request->get('date'))));
$separate = $context->hasSeparate();
?>
<div class="row">
    <div class="calendar-week-column" style="border-bottom: 2px solid black; width:100%">
        <?php $day = reset($grid);?><br><br>
        <?php foreach ($day as $cell): ?>
            <?php if($cell->date->format('H:i') >= $dateRange['start'] and $cell->date->format('H:i') < $dateRange['end']){?>
            <?php $count++;?>
            <?php $isActive = $context->isActive($cell->date);?>
            <div class="row <?=$isActive ? '' : 'active_row' ?>" style="border: 2px solid black; border-bottom:none;">
                    <?= $this->render($context->dayCellView, ['cell' => $cell, 'count' => $count, 'separate' => $separate]) ?>
            </div>
            <?php }?>
        <?php endforeach; ?>
    </div>
</div>

