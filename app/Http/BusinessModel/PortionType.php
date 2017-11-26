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
    public static $ML = 'мл';
    public static $GR = 'грамм';
    public static $PIECE = 'штук';

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
                return "";
        }
    }


    public function toInt($string)
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