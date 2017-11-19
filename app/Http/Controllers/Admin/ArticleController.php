<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 16.11.2017
 * Time: 20:41
 */

namespace App\Http\Controllers\Admin;


use App\Http\BusinessModel\ArticleType;
use App\Http\Controllers\Controller;
use App\Http\DBModel\Article;
use Yajra\Datatables\Datatables;


class ArticleController extends Controller
{

    public function deleteRow($id)
    {
        Article::destroy(["id" => $id]);
    }

    public function addItem()
    {
        $article = new Article;

//        $article2 = collect(["id" => 1000,
//            "short" => "z",
//            "full" => "z",
//            "imageId" => "z",
//            "date" => "z",
//            "type" => 2,
//            "short_en" => "z",
//            "full_en" => "z",
//            "title" => "z",
//            "title_en" => "z"
//        ]);


        $article->short = "z";
        $article->full = "z";
        $article->imageId = "z";
        $article->date = "z";
        $article->type = 2;
        $article->short_en = "z";
        $article->full_en = "z";
        $article->title = "z";
        $article->title_en = "z";
        $article->save();
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

    public function getView()
    {
        $this->addItem();
        return view(
            "admin.article",
            [
                "pageName" => "article"
            ]
        );
    }

    protected function getDateFormat()
    {
        return 'U';
    }
}