<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 08.12.2017
 * Time: 17:25
 */

namespace App\Http\BusinessModel;


class CalendarDay
{
    public $dateString;
    public $weekDay;
    public $weekDayInt;

    public $notification = [];//NotificationType
}