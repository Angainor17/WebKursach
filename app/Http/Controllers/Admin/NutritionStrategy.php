<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 16.11.2017
 * Time: 21:42
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class NutritionStrategy extends Controller
{
    public function getView()
    {
        return view("admin.nutritionstrategy", ["pageName"=>"nutritionstrategy"]);
    }
}