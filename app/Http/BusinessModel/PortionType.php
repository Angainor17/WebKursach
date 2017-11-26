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
    public static $ML = 'ML';
    public static $GR = 'GR';
    public static $PIECE = 'PCs';

    public static function toString($number)
    {
        switch ($number) {
            case 1:
                return PortionType::$ML;
            case 2:
                return PortionType::$GR;
            case 3:
                return PortionType::$PIECE;
            default:
                return "1";
        }
    }

    public static function toInt($string)
    {
        switch ($string) {
            case PortionType::$ML:
                return 1;
            case PortionType::$GR:
                return 2;
            case PortionType::$PIECE:
                return 3;
            default:
                return 0;
        }
    }
}