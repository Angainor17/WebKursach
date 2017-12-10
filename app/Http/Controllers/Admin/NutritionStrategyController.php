<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 16.11.2017
 * Time: 21:42
 */

namespace App\Http\Controllers\Admin;


use App\Http\BusinessModel\BodyType;
use App\Http\BusinessModel\CategoryType;
use App\Http\BusinessModel\NSBodyTypeListItem;
use App\Http\BusinessModel\NSListItem;
use App\Http\BusinessModel\NSPortionItem;
use App\Http\BusinessModel\PortionType;
use App\Http\Controllers\Controller;
use App\Http\DBModel\ProductTypeStrategy;
use Illuminate\Http\Request;

class NutritionStrategyController extends Controller
{
    public function getView()
    {
        return view(
            "admin.nutritionstrategy",
            [
                "pageName" => "nutritionstrategy",
                "jsonList" => json_encode($this->getList()),
            ]
        );
    }

    public function getList()
    {
        $mainList = [];
        $mainTable = ProductTypeStrategy::all();

        foreach ($mainTable as $item) {
            $mainListItem = new NSListItem;

            $mainListItem->title = CategoryType::toString($item->productType);
            $mainListItem->titleId = $item->productType;
            $mainListItem->trainingTypeId = $item->trainingType;
            $mainListItem->ageFrom = $item->ageFrom;
            $mainListItem->ageTo = $item->ageTo;

            $bodyTypesList = $item->bodyStrategys()->get();
            foreach ($bodyTypesList as $bodyTypesListItem) {
                $newBodyType = new NSBodyTypeListItem;
                $newBodyType->typeId = $bodyTypesListItem->body_type;
                $newBodyType->typeTitle = BodyType::toString($bodyTypesListItem->body_type);

                $portions = $bodyTypesListItem->portions()->get();
                foreach ($portions as $portion) {
                    $newPortion = new NSPortionItem();
                    $newPortion->size = $portion->size;
                    $newPortion->typeId = $portion->type;
                    $newPortion->type = PortionType::toString($portion->type);
                    $newBodyType->portion[$portion->type] = $newPortion;
                }

                array_push($mainListItem->bodyTypes, $newBodyType);
            }
            array_push($mainList, $mainListItem);
        }
        return $mainList;
    }

    public function update(Request $request)
    {
        $content = $request->getContent(false);
        $array = json_decode($content, true);

        $mainTable = ProductTypeStrategy::all();

        for ($i = 0; $i < count($mainTable); $i++) {
            $mainTable[$i]->ageFrom = $array[$i]['ageFrom'];
            $mainTable[$i]->ageTo = $array[$i]['ageTo'];

            $newTrainingType = $array[$i]['trainingTypeId'];
            if (empty($newTrainingType)) {
                $newTrainingType = 123;
            }

            $mainTable[$i]->trainingType = $newTrainingType;


            $bodyTypes = $mainTable[$i]->bodyStrategys()->get();
            $bodyTypesNew = $array[$i]['bodyTypes'];
            for ($j = 0; $j < 3; $j++) {
                for ($k = 0; $k < 3; $k++) {
                    $portionItem = $bodyTypes[$j]->portions()->get()->where('type', '=', $k+1)->first();
                    //return $bodyTypesNew[$j]['portion'];
                    $newValue = $bodyTypesNew[$j]['portion'][$k];
                    if (empty($newValue)) {
                        $newValue = 0;
                    }

                    $portionItem->size = intval($newValue);
                    $portionItem->save();
                }
            }
            $mainTable[$i]->save();
        }
    }
}