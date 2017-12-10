<?php

namespace App\Http\Controllers\Client;

use App\Http\BusinessModel\OrderType;
use App\Http\Controllers\Controller;
use App\Http\DBModel\Order;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function getView()
    {
        return view("client.orders");
    }

    public function getOrderList()
    {
        $orders = [];
        $userId = Auth::user()->id;

        foreach (Order::where('userId', '=', $userId)->get() as $dbOrder) {
            $newOrder = new OrderType;

            $newOrder->name = $dbOrder->name;
            $newOrder->cost = $dbOrder->cost;
            $newOrder->date = $dbOrder->date;

            $newOrder->products = $dbOrder->products()->get();

            array_push($orders, $newOrder);
        }

        return $orders;
    }

}
