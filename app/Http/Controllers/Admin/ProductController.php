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
        return json_encode(Product::where('id','=', $id)->firstOrFail());
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
            $product->ageFrom = $array['ageFrom'];
            $product->ageTo = $array['ageTo'];
            $product->discount = $array['discount'];
            $product->category = $array['category'];
            $product->portionType = $array['portionType'];
            $product->portionSize = $array['portionSize'];
            $product->portionTotal = $array['portionTotal'];
            $product->maxTime = $array['maxTime'];
            $product->breakTime = $array['breakTime'];
            $product->instock = $array['instock'];

            $product->save();
            return 'success';
        } else {
            return 'fail';
        }
    }

    public function deleteRow($id)
    {
        Product::destroy(["id" => $id]);
        return $id;
    }

    public function updateItem(Request $request)
    {
        $content = $request->getContent(false);
        $array = json_decode($content, true);

        Product::where("id", $array['id'])
            ->update(
                [
                    'name' => $array['name'],
                    'name_en' => $array['name_en'],
                    'producer' => $array['producer'],
                    'description_en' => $array['description_en'],
                    'description' => $array['description'],
                    'ageFrom' => $array['ageFrom'],
                    'ageTo' => $array['ageTo'],
                    'discount' => $array['discount'],
                    'cost' => $array['cost'],
                    'category' => $array['category'],
                    'portionType' => $array['portionType'],
                    'portionSize' => $array['portionSize'],
                    'portionTotal' => $array['portionTotal'],
                    'maxTime' => $array['maxTime'],
                    'breakTime' => $array['breakTime'],
                    'instock' => $array['instock']
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