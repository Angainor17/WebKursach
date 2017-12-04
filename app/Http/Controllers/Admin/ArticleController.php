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
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;


class ArticleController extends Controller
{

    public function deleteRow($id)
    {
        Article::destroy(["id" => $id]);
    }

    public function getArticleById($id)
    {
        return json_encode(Article::where('id', '=', $id)->firstOrFail());
    }

    public function updateItem(Request $request)
    {
        $content = $request->getContent(false);
        $array = json_decode($content, true);
        Article::where("id", $array['id'])
            ->update(
                [
                    'short' => $array['short'],
                    'short_en' => $array['short_en'],
                    'full' => $array['full'],
                    'full_en' => $array['full_en'],
                    'title' => $array['title'],
                    'title_en' => $array['title_en'],
                    'type' => $array['type']
                ]
            );
        return $array['id'];
    }

    public function addItem(Request $request)
    {
        if ($request->isMethod('post')) {

            $content = $request->getContent(false);
            $array = json_decode($content, true);

            $article = new Article;
            $article->short = $array['short'];
            $article->full = $array['full'];
            $article->imageId = $array['imageId'];
            $article->date = date("d.m.Y");
            $article->type = $array['type'];
            $article->short_en = $array['short_en'];
            $article->full_en = $array['full_en'];
            $article->title = $array['title'];
            $article->title_en = $array['title_en'];
            $article->save();
        }
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
                "pageName" => "article"
            ]
        );
    }

}