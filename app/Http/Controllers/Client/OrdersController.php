<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\DBModel\Order;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function getView()
    {
        return view("client.orders");
    }

    public function getOrderList(){
        $userId = Auth::user()->id;
        return Order::where('userId','=', $userId)->get();

    }

}
