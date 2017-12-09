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
                    $allProducts[$key]->productsTotal = $allProducts[$key]->productsTotal + $allProductsIdItem->amount;
                } else {
                    $newItem = new CalendarProduct;
                    $newItem->productId = $allProductsIdItem->product_id;
                    $newItem->productsTotal = $allProductsIdItem->amount;
                    array_push($allProducts, $newItem);
                }
            }
        }

        foreach ($allProducts as $product) {
            $product->product = Product::where('id', '=', $product->productId)->get()->first();
            $product->portionsLast = $product->productsTotal * $product->product->portionTotal;
            $product->portionSize = $product->product->portionSize;
            $product->portionType = $product->product->portionType;
        }

        $meals = Auth::user()->meals()->get();
        foreach ($meals as $meal) {
            foreach ($allProducts as $product) {
                if ($meal->product_id == $product->productId) {
                    $product->portionsLast = $product->portionsLast - $meal->portions_used;
                    if ($product->portionsLast < 0) {
                        $product->portionsLast = 0;
                    }
                }
            }
        }
        return $allProducts;
    }
}
