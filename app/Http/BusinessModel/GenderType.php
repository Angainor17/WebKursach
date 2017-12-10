<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 18.11.2017
 * Time: 10:36
 */

namespace App\Http\BusinessModel;


class GenderType
{

    public static function toString($number)
    {
        switch ($number) {
            case 1:
                return trans('app.male');
            case 2:
                return trans('app.female');
            default:
                return "";
        }
    }
}