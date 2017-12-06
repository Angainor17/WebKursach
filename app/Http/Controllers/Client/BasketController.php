<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\DBModel\Order;
use App\Http\DBModel\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function getView()
    {
        return view("client.basket");
    }

    public function getProductList()
    {
        $lang = app()->getLocale();

        return json_encode(Auth::user()->products()->get()->map(function ($data) use ($lang) {
            if ($lang == "en") {
                $data->name = $data->name_en;
            }

            if ($data->discount > 0) {
                $newCost = intval(floatval($data->cost) * (floatval(100 - $data->discount) / 100.0));
                $data->discount = $newCost;
            }
            return $data;
        }));
    }

    public function getTotalCost()
    {
        return Auth::user()->getTotalCost();
    }

    public function remove($id)
    {
        $userId = Auth::user()->id;
        Product::where('id', '=', $id)->get()->first()->users()->detach($userId);
    }

    public function makeOrder(Request $request)
    {
        $userId = Auth::user()->id;
        $productList = $request->list;

        $order = new Order;
        $order->date = date("d.m.Y");
        $order->cost = "" . $request->cost;
        $order->name = "" . $request->name;
        $order->address = "" . $request->address;
        $order->telephoneNumber = "" . $request->telephoneNumber;
        $order->city = "" . $request->city;
        $order->comment = "" . $request->comment;
        $order->userId = $userId;
        $order->save();


        foreach ($productList as $product) {
            Order::where('id', '=', $order->id)->get()->first()->products()->attach($product['id'], ['amount' => $product['amount']]);

//            Auth::user()->products()->detach($product['id']);
        }

    }
}
