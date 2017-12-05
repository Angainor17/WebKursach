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
        $lang = app()->getLocale();

        return json_encode(Auth::user()->products()->get()->map(function ($data) use ($lang) {
//            if ($data->instock > 0) {
//                $data->instock = trans('app.instockHas');
//            } else {
//                $data->instock = trans('app.instockNo');
//            }

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
}
