<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 09.12.2017
 * Time: 4:21
 */

namespace App\Http\BusinessModel;


class WeekDay
{
    public static function getString($number)
    {
        switch ($number) {
            case 1:
                return trans('app.monday');
            case 2:
                return trans('app.tuesday');
            case 3:
                return trans('app.wednesday');
            case 4:
                return trans('app.thursday');
            case 5:
                return trans('app.friday');
            case 6:
                return trans('app.saturday');
            case 7:
                return trans('app.sunday');

        }
        return "";
    }

    public static function isSelected($string, $number)
    {
        if (strpos($string, $number) !== false) {
            return "checked";
        } else {
            return "";
        }
    }

}