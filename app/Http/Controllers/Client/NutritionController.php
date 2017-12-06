<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class NutritionController extends Controller
{
    public function getView()
    {
        return view("client.nutrition");
    }

}
