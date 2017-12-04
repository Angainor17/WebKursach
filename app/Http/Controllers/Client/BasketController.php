<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function getView()
    {
        return view("client.basket");
    }

    public function getProductList()
    {
        return json_encode(Auth::user()->products()->get());
    }
}
