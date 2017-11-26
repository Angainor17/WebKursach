<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 16.11.2017
 * Time: 20:52
 */

namespace App\Http\Controllers\Admin;


use App\Http\BusinessModel\CategoryType;
use App\Http\BusinessModel\PortionType;
use App\Http\Controllers\Controller;
use App\Http\DBModel\Product;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ProductController extends Controller
{
    function getView()
    {
        return view(
            "admin.products",
            [
                "pageName" => "product"
            ]
        );
    }

    public function getProductById($id)
    {
        return json_encode(Product::all()->where("id", $id)->first()->take(1)->get());
    }

    public function addItem(Request $request)
    {
        if ($request->isMethod('post')) {

            $content = $request->getContent(false);
            $array = json_decode($content, true);

            $product = new Product;
            $product->name = $array['name'];
            $product->name_en = $array['name_en'];
            $product->producer = $array['producer'];
            $product->description = $array['description'];
            $product->description_en = $array['description_en'];
            $product->imageId = $array['imageId'];
            $product->cost = $array['cost'];
            $product->discount = $array['discount'];
            $product->category = $array['category'];
            $product->portionType = $array['portionType'];
            $product->portionSize = $array['portionSize'];
            $product->portionTotal = $array['portionTotal'];
            $product->maxTime = $array['maxTime'];
            $product->breakTime = $array['breakTime'];
            $product->instock = $array['instock'];

            $product->save();
        }
    }

    public function deleteRow($id)
    {
        Product::destroy(["id" => $id]);
    }

    public function updateItem(Request $request)
    {
        $content = $request->getContent(false);
        $array = json_decode($content, true);

        Product::where("id", $array['id'])
            ->update(
                [
                    'name' => 'name',
                    'name_en' => 'name_en',
                    'producer' => 'producer',
                    'description_en' => 'description_en',
                    'description' => 'description',
                    'ageFrom' => 'ageFrom',
                    'ageTo' => 'ageTo',
                    'imageId' => 'imageId',
                    'discount' => 'discount',
                    'cost' => 'cost',
                    'category' => 'category',
                    'portionType' => 'portionType',
                    'portionSize' => 'portionSize',
                    'portionTotal' => 'portionTotal',
                    'maxTime' => 'maxTime',
                    'breakTime' => 'breakTime',
                    'instock' => 'instock',
                ]
            );
        return $array['id'];
    }

    public function getProductsDataTable()
    {
        return Datatables::of(Product::all(
            [
                "id",
                "name",
                "producer",
                "category",
                "cost",
                "discount",
                "portionSize",
                "portionType",
                "portionTotal"
            ]
        ))
            ->editColumn("category", function ($info) {
                return CategoryType::toString($info->category);
            })
            ->editColumn("cost", function ($info) {
                return $info->cost . ' RUB';
            })
            ->editColumn("discount", function ($info) {
                return $info->discount . ' %';
            })
            ->editColumn("portionsSize", function ($info) {
                $portType = PortionType::toString($info->portionType);
                return $info->portionTotal . ' portions by ' . $info->portionSize . ' ' . $portType;
            })
            ->make(true);
    }
}