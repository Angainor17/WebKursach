<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 18.11.2017
 * Time: 10:37
 */

namespace App\Http\BusinessModel;


class TrainingType
{
//    public static $MASS = 'масса';
//    public static $DRY = 'сушка';
//    public static $STAMINA = 'выносливость';

    public static function toString($number)
    {
        switch ($number) {
            case 1:
                return trans('app.mass');
            case 2:
                return trans('app.dry');
            case 3:
                return trans('app.stamina');
            default:
                return "";
        }
    }

    public static function isSelected($string, $number)
    {
       if($string == $number){
           return "selected";
       }else{
           return "";
       }
    }
}