<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function getView()
    {
        return view("client.orders");
    }

}
