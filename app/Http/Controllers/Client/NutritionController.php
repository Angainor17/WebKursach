<?php

namespace App\Http\Controllers\Client;

use App\Http\BusinessModel\CalendarProduct;
use App\Http\Controllers\Controller;
use App\Http\DBModel\Order;
use App\Http\DBModel\OrderProduct;
use App\Http\DBModel\Product;
use Illuminate\Support\Facades\Auth;

class NutritionController extends Controller
{
    public function getView()
    {
        $item = $this->getR();
        return view(
            "client.nutrition",
            [
                "dump" => $item
            ]
        );
    }

    public function getR()
    {
        $result = $this->getProductsData();

        return dump($result);
    }
//4744
    public function getProductsData()
    {
        $userId = Auth::user()->id;
        $allOrders = Order::where('userId', '=', $userId)->get();
        $allProducts = [];

        foreach ($allOrders as $order) {
            $allProductsId = OrderProduct::where('order_id', '=', $order->id)->get();

            foreach ($allProductsId as $allProductsIdItem) {
                $isChecked = false;
                $key = -1;

                foreach ($allProducts as $key1 => $value) {
                    if ($value->productId == $allProductsIdItem->product_id) {
                        $isChecked = true;
                        $key = $key1;
                    }
                }

                if ($isChecked) {
                    $allProducts[$key]->portionsAmount = $allProducts[$key]->portionsAmount + $allProductsIdItem->amount;
                } else {
                    $newItem = new CalendarProduct;
                    $newItem->productId = $allProductsIdItem->product_id;
                    $newItem->portionsAmount = $allProductsIdItem->amount;
                    array_push($allProducts, $newItem);
                }
            }
        }

        foreach ($allProducts as $product){
            $product->product = Product::where('id','=',$product->productId)->get()->first();
        }
        return $allProducts;
    }

}
