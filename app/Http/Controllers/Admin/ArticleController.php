<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 16.11.2017
 * Time: 20:41
 */

namespace App\Http\Controllers\Admin;


use App\Article;
use App\Http\ArticleType;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;


class ArticleController extends Controller
{

    public function getArticleList()
    {
        return "111";
    }

    public function deleteRow()
    {
//        $id = Input::get("id", 0);
        Article::destroy(["id" => 5]);
        return "";
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
        return view(
            "admin.article",
            [
                "pageName" => "article",
                "articles" => $this->getArticleList(),
            ]
        );
    }

    protected function getDateFormat()
    {
        return 'U';
    }
}