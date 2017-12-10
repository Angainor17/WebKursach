<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 18.11.2017
 * Time: 10:19
 */

namespace App\Http\BusinessModel;


class CategoryType
{
    public static function toString($number)
    {
        switch ($number) {
            case 1:
                return trans('app.protein');
            case 2:
                return trans('app.vitamin');
            case 3:
                return trans('app.tonik');
            case 4:
                return trans('app.aminoacid');
            case 5:
                return trans('app.gainer');
            default:
                return "";
        }
    }
}