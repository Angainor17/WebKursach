<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class NewsPageController extends Controller
{
    public function getView(){
        return view(
            "client.newsPage",
            [
                "pageName" => "News"
            ]
        );
    }

    //
}
