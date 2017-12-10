<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 18.11.2017
 * Time: 10:09
 */

namespace App\Http\BusinessModel;


class BodyType
{

    public static function toString($number)
    {
        switch ($number) {
            case 1:
                return trans('app.ectomorph');
            case 2:
                return trans('app.endomorph');
            case 3:
                return trans('app.mezomorph');
            default:
                return "";
        }
    }
}