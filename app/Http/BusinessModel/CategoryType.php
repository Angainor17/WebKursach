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

    public static function toString($number)
    {
        switch ($number) {
            case 1:
                return CategoryType::$PROTEIN;
            case 2:
                return CategoryType::$VITAMIN;
            case 3:
                return CategoryType::$TONIK;
            default:
                return "";
        }
    }

    public function toInt($string)
    {
        switch ($string) {
            case CategoryType::$PROTEIN:
                return 1;
            case CategoryType::$VITAMIN:
                return 2;
            case CategoryType::$TONIK:
                return 3;
            default:
                return 0;
        }
    }
}