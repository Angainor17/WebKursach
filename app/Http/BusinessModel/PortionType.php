<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 18.11.2017
 * Time: 10:16
 */

namespace App\Http\BusinessModel;


class PortionType
{

    public static function toString($number)
    {
        switch ($number) {
            case 1:
                return trans('app.ml');
            case 2:
                return trans('app.gr');
            case 3:
                return trans('app.pcs');
            default:
                return "1";
        }
    }

    public static function isChecked($id, $currentId)
    {
        if ($id == $currentId) {
            return "selected = selected";
        } else {
            return "";
        }
    }

}