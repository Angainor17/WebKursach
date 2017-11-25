<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 16.11.2017
 * Time: 20:52
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\DBModel\Product;
use Yajra\Datatables\Datatables;

class ProductArticle extends Controller
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

    public function getArticleDataTable()
    {
        return Datatables::of(Article::all(
            [
                "id",
                "short",
                "full",
                "date",
                "type"
            ]
        ))
            ->editColumn("type", function ($type) {
                return ArticleType::toString($type->type);
            })
            ->make(true);
    }
}