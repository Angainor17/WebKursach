<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.12.2017
 * Time: 16:18
 */

namespace App\Http\BusinessModel;


class NSBodyTypeListItem
{
    public $typeTitle;
    public $typeId;

    //3 because of PortionType
    public $portion = array(
        1 => "",
        2 => "",
        3 => ""
    );
}