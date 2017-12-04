<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\DBModel\Product;

class BasketController extends Controller
{
    public function getView()
    {
        return view("client.basket");
    }

    public function getProductList(){
        return json_encode(Product::orderBy('id', 'desc')->get());
    }
}
