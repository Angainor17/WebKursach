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
    public static $PROTEIN = 'Protein';
    public static $VITAMIN = 'Vitamin';
    public static $TONIK = 'Tonik';
    public static $AMINOACID = 'Amino';
    public static $GAINER = 'Gainer';

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

//    public static function toInt($string)
//    {
//        switch ($string) {
//            case CategoryType::$PROTEIN:
//                return 1;
//            case CategoryType::$VITAMIN:
//                return 2;
//            case CategoryType::$TONIK:
//                return 3;
//            case CategoryType::$TONIK:
//                return 3;
//            case CategoryType::$TONIK:
//                return 3;
//            default:
//                return 0;
//        }
//    }
}