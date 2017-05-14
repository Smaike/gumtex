<?php
/**
 * @var \DatePeriod $period
 * @var CalendarWidget $context
 * @var \yii\web\View $this
 */
use understeam\calendar\CalendarInterface;
use understeam\calendar\CalendarWidget;
use yii\helpers\Html;
use yii\helpers\Url;

$context = $this->context;
?>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i>', $context->getPrevUrl()) ?>
            <?= $context->getPeriodString() ?>
            <?= Html::a('<i class="glyphicon glyphicon-chevron-right"></i>', $context->getNextUrl()) ?>
        </div>
        <div class="col-sm-1 pull-right">
            <?php if ($context->viewMode == CalendarInterface::VIEW_MODE_MONTH): ?>
                <?= Html::a('<i class="glyphicon glyphicon-list"></i>', $context->getWeekViewUrl()) ?>
            <?php else: ?>
                <?= Html::a('<i class="glyphicon glyphicon-calendar"></i>', $context->getMonthViewUrl()) ?>
            <?php endif; ?>
        </div>
    </div>
</div>
