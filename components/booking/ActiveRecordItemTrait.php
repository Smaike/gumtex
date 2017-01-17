<?php
/**
 * @link https://github.com/AnatolyRugalev
 * @copyright Copyright (c) AnatolyRugalev
 * @license https://tldrlegal.com/license/gnu-general-public-license-v3-(gpl-3)
 */

namespace app\components\booking;

use Yii;

/**
 * @author Anatoly Rugalev
 * @link https://github.com/AnatolyRugalev
 */
trait ActiveRecordItemTrait
{

    /**
     * @var ActiveRecordCalendar
     */
    private $_calendar;

    /**
     * @return int
     */
    public function getTimestamp()
    {
        return strtotime($this->{$this->_calendar->dateAttribute});
    }

    public function getEndTimestamp()
    {
        return strtotime($this->{$this->_calendar->dateEndAttribute});
    }

    /**
     * @return ActiveRecordCalendar
     */
    public function getCalendar()
    {
        return $this->_calendar;
    }

    /**
     * @param CalendarInterface $calendar
     */
    public function setCalendar(CalendarInterface $calendar)
    {
        $this->_calendar = $calendar;
    }
}