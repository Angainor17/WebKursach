<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.12.2017
 * Time: 16:14
 */

namespace App\Http\BusinessModel;


class NSListItem
{
    public $title;
    public $titleId;
    public $trainingTypeId;
    public $ageFrom;
    public $ageTo;

    public $bodyTypes = [];//NSBodyTypeListItem
}