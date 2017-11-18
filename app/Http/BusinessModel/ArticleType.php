<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 17.11.2017
 * Time: 21:37
 */

namespace App\Http;


class ArticleType
{
    public static $NEWS = 'News';
    public static $ACTION = 'Action';

    public static function toString($number)
    {
        switch ($number) {
            case 1:
                return ArticleType::$NEWS;
            case 2:
                return ArticleType::$ACTION;
            default:
                return "";
        }
    }

    public function toInt($string)
    {
        switch ($string) {
            case ArticleType::$NEWS:
                return 1;
            case ArticleType::$ACTION:
                return 2;
            default:
                return 0;
        }
    }
}