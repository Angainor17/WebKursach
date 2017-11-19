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
    public static $MALE = 'male';
    public static $FEMALE = 'female';

    public static function toString($number)
    {
        switch ($number) {
            case 1:
                return GenderType::$MALE;
            case 2:
                return GenderType::$FEMALE;
            default:
                return "";
        }
    }


    public function toInt($string)
    {
        switch ($string) {
            case GenderType::$MALE:
                return 1;
            case GenderType::$FEMALE:
                return 2;
            default:
                return 0;
        }
    }
}