<?php
/**
 * @var array $grid
 * @var \understeam\calendar\CalendarWidget $context
 * @var \yii\web\View $this
 */
use understeam\calendar\CalendarHelper;

echo $this->render('header');
$context = $this->context;
?>
<div class="row">
    <div class="calendar-week-column" style="border-bottom: 1px solid black;">
        <?php
        $day = reset($grid);
        ?>
        <?php foreach ($day as $cell): ?>
            <?php $isActive = $context->isActive($cell->date);?>
            <div class="row <?=$isActive ? '' : ' active_row' ?>" style="border: 1px solid black; border-bottom:none;">
                    <?= $this->render($context->dayCellView, ['cell' => $cell]) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

