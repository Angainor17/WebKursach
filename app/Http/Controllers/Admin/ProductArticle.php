<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 16.11.2017
 * Time: 20:52
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class ProductArticle extends Controller
{
    function getView()
    {
        return view("admin.products",["pageName"=>"product"]);
    }

}