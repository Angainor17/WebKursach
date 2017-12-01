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
        return json_encode(Article::orderBy('id', 'desc')->get());
    }
}
