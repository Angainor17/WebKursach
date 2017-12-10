<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\DBModel\Basket;
use App\Http\DBModel\Product;
use Illuminate\Support\Facades\Auth;

class SelectedProductController extends Controller
{

    public function getItemById($locale, $id)
    {
        return Product::where('id', '=', $id)->get()->map(
            function ($data) use ($locale) {
                if ($locale == "en") {
                    $data->title = $data->title_en;
                    $data->full = $data->full_en;
                }
                return $data;
            }
        );
    }

    public function getView($id)
    {
        $locale = app()->getLocale();
        $product = $this->getItemById($locale, $id)[0];

        $title = "";
        if (app()->getLocale() == "en") {
            $title = $product->name_en;
            $product->name = $product->name_en;
            $product->description = $product->description_en;
        } else {
            $title = $product->name;
        }

        $isInBasket = false;
        if (!Auth::guest()) {
            $userId = Auth::user()->id;
            $isInBasket = !Basket::where('user_id', '=', $userId)->where('product_id', '=', $id)->get()->isEmpty();
        }

        if ($isInBasket) {
            $buyBtn = trans('app.alreadyInCartLabel');
        } else {
            $buyBtn = trans('app.inCartLabel');
        }

        return view("client.selectedProductPage",
            [
                "title" => $title,
                "item" => $product,
                "buyButtonText" => $buyBtn,
            ]
        );
    }
}
