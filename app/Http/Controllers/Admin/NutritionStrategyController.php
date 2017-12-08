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

    public function update()
    {

    }
}