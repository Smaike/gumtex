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
    <div class="calendar-week-column">
        <?php
        $day = reset($grid);
        ?>
        <?php foreach ($day as $cell): ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <?= $cell->date->format('H:i') ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php foreach ($grid as $day): ?>
        <div class="calendar-week-column">
            <?php foreach ($day as $cell): ?>
                <?= $this->render($context->weekCellView, ['cell' => $cell]) ?>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>

