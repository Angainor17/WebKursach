<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\DBModel\Article;

class NewsPageController extends Controller
{
    public function getView()
    {
        return view(
            "client.newsPage",
            [
                "pageName" => "News"
            ]
        );
    }

    public function getArticlesList()
    {
        $lang = app()->getLocale();
        return json_encode(Article::orderBy('id', 'desc')->get()->map(
            function ($data) use ($lang) {
                if ($lang == "en") {
                    $data->title = $data->title_en;
                    $data->short = $data->short_en;
                    return $data;
                }
                if ($lang == "ru") {
                    return $data;
                }
                return $data;
            }
        ));
    }
}
