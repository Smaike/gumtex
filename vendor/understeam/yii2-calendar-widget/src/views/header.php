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
        <?php if ($context->viewMode == CalendarInterface::VIEW_MODE_DAY): ?>
            <div class="col-sm-4" style="text-align: center;">
                <?= Html::a('15', Url::current(['minute_period' => 15])) ?>
                <?= Html::a('30', Url::current(['minute_period' => 30])) ?>
                <?= Html::a('45', Url::current(['minute_period' => 45])) ?>
                <?= Html::a('60', Url::current(['minute_period' => 60])) ?>
            </div>
        <?php endif; ?>
        <div class="col-sm-1 pull-right">
            <?php if ($context->viewMode == CalendarInterface::VIEW_MODE_MONTH): ?>
                <?= Html::a('<i class="glyphicon glyphicon-list"></i>', $context->getWeekViewUrl()) ?>
            <?php else: ?>
                <?= Html::a('<i class="glyphicon glyphicon-calendar"></i>', $context->getMonthViewUrl()) ?>
            <?php endif; ?>
        </div>
    </div>
</div>
