<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\DBModel\Product;

class SelectedProductController extends Controller
{

    public function getItemById($locale, $id)
    {
        return Product::where('id', '=', $id)->get()->map(
            function ($data) use ($locale) {
                if ($locale == "en") {
                    $data->title = $data->title_en;
                    $data->full = $data->full_en;
                    return $data;
                }
                return "";
            }
        );
    }

    public function getView($id)
    {
        $locale = app()->getLocale();
        $article = $this->getItemById($locale, $id)[0];

        return view("client.selectedProductPage",
            [
                "title" => $article->title,
                "item" => $article,
            ]
        );
    }
}
