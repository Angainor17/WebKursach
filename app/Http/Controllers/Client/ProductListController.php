<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\DBModel\Basket;
use App\Http\DBModel\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductListController extends Controller
{
    public function getView()
    {
        return view("client.productList");
    }

    public function addToCart(Request $request)
    {
        $item = new Basket;
        $item->userId = Auth::user()->id;
        $item->productId = $request->idProduct;
        $item->save();
    }

    public function getProductsList()
    {
        $lang = app()->getLocale();

        return json_encode(Product::orderBy('id', 'desc')->get()->map(function ($data) use ($lang) {
            if ($data->instock > 0) {
                $data->instock = trans('app.instockHas');
            } else {
                $data->instock = trans('app.instockNo');
            }

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
}
