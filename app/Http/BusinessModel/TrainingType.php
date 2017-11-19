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
    public static $MASS = 'масса';
    public static $DRY = 'сушка';
    public static $STAMINA = 'выносливость';

    public static function toString($number)
    {
        switch ($number) {
            case 1:
                return TrainingType::$MASS;
            case 2:
                return TrainingType::$DRY;
            case 3:
                return TrainingType::$STAMINA;
            default:
                return "";
        }
    }

    public function toInt($string)
    {
        switch ($string) {
            case TrainingType::$MASS:
                return 1;
            case TrainingType::$DRY:
                return 2;
            case TrainingType::$STAMINA:
                return 3;
            default:
                return 0;
        }
    }
}