<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\DBModel\Product;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function getView()
    {
        return view("client.basket");
    }

    public function getProductList()
    {
//        $userId = Auth::user()->id;

        //return json_encode(Basket::where('userId','=', $userId)->get());
//        Basket::where('userId','=', $userId)->get('');
        $product =  new Product;
        $product->belongsTo('users',);
        $product->save();
        return json_encode(
            Auth::user()->products()
        );
//        return json_encode(Product::where('id','=', )->get());
    }
}
