<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\DBModel\Product;

class ProductListController extends Controller
{
    public function getView()
    {
        return view(
            "client.productList",
            [
                "pageName" => "News"
            ]
        );
    }

    public function getProductsList()
    {
        return json_encode(Product::orderBy('id', 'desc')->get());
    }
}
