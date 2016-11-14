<?php
/**
 * @link https://github.com/AnatolyRugalev
 * @copyright Copyright (c) AnatolyRugalev
 * @license https://tldrlegal.com/license/gnu-general-public-license-v3-(gpl-3)
 */

namespace understeam\calendar;

use yii\base\Model;

/**
 * Class CalendarActionForm TODO: Write class description
 * @author Anatoly Rugalev
 * @link https://github.com/AnatolyRugalev
 */
class CalendarActionForm extends Model
{

    public $viewMode;

    public $date;

    public $minute_period;

    /**
     * @var CalendarInterface
     */
    public $calendar;

    public function __construct(CalendarInterface $calendar, array $config = [])
    {
        parent::__construct($config);
        $this->calendar = $calendar;
    }

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            ['viewMode', 'default', 'value' => CalendarInterface::VIEW_MODE_MONTH],
            ['date', 'default', 'value' => date('Y-m-d')],
            ['viewMode', 'in', 'range' => [CalendarInterface::VIEW_MODE_MONTH, CalendarInterface::VIEW_MODE_WEEK,  CalendarInterface::VIEW_MODE_DAY]],
            ['date', 'date', 'format' => 'php:Y-m-d'],
            ['minute_period', 'default', 'value' => 60],
            ['minute_period', 'in', 'range' => [30, 45, 60]],
        ];
    }

    /**
     * @return \DatePeriod
     */
    public function getPeriod()
    {
        if ($this->viewMode == CalendarInterface::VIEW_MODE_MONTH) {
            return CalendarHelper::getMonthPeriod($this->date);
        } elseif($this->viewMode == CalendarInterface::VIEW_MODE_WEEK) {
            return CalendarHelper::getWeekPeriod($this->date);
        } else {
            return CalendarHelper::getDayPeriod($this->date);
        }
    }

    /**
     * @return \DatePeriod
     */
    public function getDisplayPeriod()
    {
        if ($this->viewMode == CalendarInterface::VIEW_MODE_MONTH) {
            return CalendarHelper::getMonthDisplayPeriod($this->date);
        } elseif($this->viewMode == CalendarInterface::VIEW_MODE_WEEK) {
            return CalendarHelper::getWeekDisplayPeriod($this->date, $this->minute_period);
        } else {
            return CalendarHelper::getDayDisplayPeriod($this->date, $this->minute_period);
        }
    }

    /**
     * @return array
     */
    public function getGrid()
    {
        $period = $this->getDisplayPeriod();
        $models = $this->calendar->findItems(
            $period->getStartDate()->getTimestamp(),
            $period->getEndDate()->getTimestamp()
        );
        if ($this->viewMode == CalendarInterface::VIEW_MODE_MONTH) {
            $grid = CalendarHelper::composeMonthGrid($period, $models);
        } else {
            $grid = CalendarHelper::composeWeekGrid($period, $models);
        } 
        return $grid;
    }

}
