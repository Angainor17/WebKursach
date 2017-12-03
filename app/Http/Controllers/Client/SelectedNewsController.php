<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\DBModel\Article;

class SelectedNewsController extends Controller
{

    public function getItemById($locale, $id)
    {
        return Article::where('id', '=', $id)->get()->map(
            function ($data) use ($locale) {
                if ($locale == "en") {
                    $data->title = $data->title_en;
                    $data->full = $data->full_en;
                    return $data;
                }

                if ($locale == "ru") {
                    return $data;
                }

                return $data;
            }
        );
    }

    public function getView($id)
    {
        $locale = app()->getLocale();
        $article = $this->getItemById($locale, $id)[0];

        return view("client.selectedNewsPage",
            [
                "title" => $article->title,
                "item" => $article,
            ]
        );
    }
}
