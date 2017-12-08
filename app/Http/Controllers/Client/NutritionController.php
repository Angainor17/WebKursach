<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class NutritionController extends Controller
{
    public function getView()
    {
        $item = $this->getR();
        return view(
            "client.nutrition",
            [
                "dump" => $item
            ]
        );
    }

    public function getR()
    {
        $result = $this->getData();

        return dump($result);
    }

    public function getData(){
        $allProducts = ;




    }

}
