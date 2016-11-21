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
    <div class="calendar-week-column" style="border-bottom: 2px solid black; width:100%">
        <?php $day = reset($grid);?>
            <div class="row">
                <div class="col-sm-1">
                    <div>
                        <div class="panel-body">
                            Время
                        </div>
                    </div>
                </div>
                <div class="col-sm-11">
                    <div class="row panel-body">
                        <div class="col-sm-4">ФИО клиента</div>
                        <div class="col-sm-1">лет</div>
                        <div class="col-sm-2">услуга</div>
                        <div class="col-sm-2">консультант</div>
                        <div class="col-sm-3">комментарии</div>
                    </div>
                </div>
            </div>
        <?php foreach ($day as $cell): ?>
            <?php if($cell->date->format('H') >= 10 and $cell->date->format('H') <= 19){?>
            <?php $isActive = $context->isActive($cell->date);?>
            <div class="row <?=$isActive ? '' : ' active_row' ?>" style="border: 2px solid black; border-bottom:none;">
                    <?= $this->render($context->dayCellView, ['cell' => $cell]) ?>
            </div>
            <?php }?>
        <?php endforeach; ?>
    </div>
</div>

