<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function getView()
    {
        return view("client.about");
    }
}
