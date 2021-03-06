<?php
/**
 * @link https://github.com/AnatolyRugalev
 * @copyright Copyright (c) AnatolyRugalev
 * @license https://tldrlegal.com/license/gnu-general-public-license-v3-(gpl-3)
 */

namespace app\components\booking;

use DateTime;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * Виджет для отображения календаря
 *
 * @property string $viewMode режим просмотра. Определяется на основе сессии, однако можно задать вручную
 *
 * @author Anatoly Rugalev
 * @link https://github.com/AnatolyRugalev
 */
class CalendarWidget extends Widget
{

    /**
     * @var array сетка моделей для отображения
     */
    public $grid;

    /**
     * @var CalendarInterface компонент календаря
     */
    public $calendar;

    /**
     * @var string View файл для режима "неделя"
     */
    public $weekView = '@app/components/booking/views/week';

    /**
     * @var string View файл для режима "месяц"
     */
    public $monthView = '@app/components/booking/views/month';

    /**
     * @var string View файл для ячейки режима "неделя"
     */
    public $weekCellView = '@app/components/booking/views/week_cell';

    /**
     * @var string View файл для ячейки режима "месяц"
     */
    public $monthCellView = '@app/components/booking/views/month_cell';

    /**
     * @var string View файл для ячейки режима "день"
     */
    public $dayCellView = '@app/components/booking/views/day_cell';

    /**
     * @var string View файл для режима "неделя"
     */
    public $dayView = '@app/components/booking/views/day';

    /**
     * @var string устанавливает режим просмотра
     */
    public $viewMode;

    /**
     * @var \DatePeriod период времени, который следует отобразить
     */
    public $period;

    /**
     * @var string Action, на который будет производиться переход по ссылкам. По умолчанию текущий
     */
    public $action;

    public $actionDateParam = 'date';

    public $actionViewModeParam = 'viewMode';

    public $clientOptions = [];

    public function run()
    {
        $this->registerAssets();
        $result = Html::beginTag('div', [
            'class' => 'calendar-widget',
            'id' => $this->getId()
        ]);
        if ($this->viewMode == CalendarInterface::VIEW_MODE_WEEK) {
            $result .= $this->renderWeek();
        } elseif( $this->viewMode == CalendarInterface::VIEW_MODE_MONTH ) {
            $result .= $this->renderMonth();
        } else {
            $result .= $this->renderDay();
        }
        $result .= Html::endTag('div');
        return $result;
    }

    public function renderWeek()
    {
        return $this->render($this->weekView, [
            'grid' => $this->grid,
        ]);
    }

    public function renderMonth()
    {
        return $this->render($this->monthView, [
            'grid' => $this->grid,
        ]);
    }

    public function renderDay()
    {
        return $this->render($this->dayView, [
            'grid' => $this->grid,
        ]);
    }

    public function getActionUrl()
    {
        if (!$this->action) {
            return [Yii::$app->controller->getRoute()];
        } else {
            return [$this->action];
        }
    }

    public function getWeekViewUrl()
    {
        $url = $this->getActionUrl();
        $url[$this->actionDateParam] = $this->period->getStartDate()->format('Y-m-d');
        $url[$this->actionViewModeParam] = CalendarInterface::VIEW_MODE_WEEK;
        $url['room'] = Yii::$app->request->get('room');
        return $url;
    }

    public function getMonthViewUrl()
    {
        $url = $this->getActionUrl();
        $url[$this->actionDateParam] = $this->period->getEndDate()->sub(new \DateInterval('P1D'))->format('Y-m-d');
        $url[$this->actionViewModeParam] = CalendarInterface::VIEW_MODE_MONTH;
        $url['room'] = Yii::$app->request->get('room');
        return $url;
    }

    public function getNextUrl()
    {
        $url = $this->getActionUrl();
        $url[$this->actionDateParam] = $this->getNextDate()->format('Y-m-d');
        $url[$this->actionViewModeParam] = $this->viewMode;
        return $url;
    }

    public function getPrevUrl()
    {
        $url = $this->getActionUrl();
        $url[$this->actionDateParam] = $this->getPrevDate()->format('Y-m-d');
        $url[$this->actionViewModeParam] = $this->viewMode;
        return $url;
    }

    /**
     * @return \DateTime
     */
    public function getNextDate()
    {
        return $this->period->getEndDate();
    }

    /**
     * @return \DateTime
     */
    public function getPrevDate()
    {
        /** @var \DateTime $date */
        $date = $this->period->getStartDate();
        $date->sub(new \DateInterval($this->viewMode == CalendarInterface::VIEW_MODE_DAY ? 'P1D' : 'P1M')); //менял с VIEW_MODE_WEEK
        return $date;
    }

    public function getPeriodString()
    {
        $firstDay = $this->period->getStartDate();
        $lastDay = $this->period->getEndDate();
        $lastDay->sub(new \DateInterval('P1D'));

        $left = [(int)$firstDay->format('d')];
        $right = [(int)$lastDay->format('d')];
        $common = [];

        if ($firstDay->format('m') == $lastDay->format('m')) {
            $common[] = Yii::$app->formatter->asDate($firstDay, 'MMM');
        } else {
            $left[] = Yii::$app->formatter->asDate($firstDay, 'MMM');
            $right[] = Yii::$app->formatter->asDate($lastDay, 'MMM');
        }

        if ($firstDay->format('Y') == $lastDay->format('Y')) {
            $common[] = Yii::$app->formatter->asDate($lastDay, 'Y');
        } else {
            $left[] = Yii::$app->formatter->asDate($firstDay, 'Y');
            $right[] = Yii::$app->formatter->asDate($lastDay, 'Y');
        }

        $string = implode(' ', $left) . ' — ' . implode(' ', $right);
        if (count($common)) {
            $string .= ' ' . implode(' ', $common);
        }
        return $string;
    }

    protected function registerAssets()
    {
        $id = $this->getId();
        $options = Json::htmlEncode($this->clientOptions);
        $view = $this->getView();
        $view->registerJs("jQuery('#$id').yiiCalendar($options);");
    }

    public function isInPeriod(DateTime $date)
    {
        return $date->getTimestamp() >= $this->period->getStartDate()->getTimestamp()
        && $date->getTimestamp() < $this->period->getEnddate()->getTimestamp();
    }

    public function isActive(DateTime $date)
    {
        $bounds = $this->calendar->getAllowedDateRange();
        $startTs = isset($bounds[0]) ? $bounds[0] : null;
        $endTs = isset($bounds[1]) ? $bounds[1] : null;
        $condition = true;
        if ($startTs !== null) {
            $condition = $condition && ($date->getTimestamp() >= $startTs || ($this->viewMode == CalendarInterface::VIEW_MODE_MONTH && $date->format('Y-m-d') == date('Y-m-d')));
        }
        if ($endTs !== null) {
            $condition = $condition && $date->getTimestamp() < $endTs;
        }
        return $condition;
    }
}
