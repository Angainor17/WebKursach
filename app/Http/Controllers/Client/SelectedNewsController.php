<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\DBModel\Article;

class SelectedNewsController extends Controller
{

    public function getItemById($id)
    {
        return Article::where('id', '=', $id)->firstOrFail();
    }

    public function getView($id)
    {
        $article = $this->getItemById($id);

        return view("client.selectedNewsPage",
            [
                "title" => $article->title,
                "item" => $article,
            ]
        );
    }
}
