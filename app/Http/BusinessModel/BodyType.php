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
//    public static $ECTOMORPH = 'Ectomorph';
//    public static $ENDOMORPH = 'Endomorph';
//    public static $MEZOMORPH = 'Mezomorph';

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

//    public function toInt($string)
//    {
//        switch ($string) {
//            case BodyType::$ECTOMORPH:
//                return 1;
//            case BodyType::$ENDOMORPH:
//                return 2;
//            case BodyType::$MEZOMORPH:
//                return 3;
//            default:
//                return 0;
//        }
//    }

}