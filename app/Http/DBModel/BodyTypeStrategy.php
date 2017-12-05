<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 18.11.2017
 * Time: 10:28
 */

namespace App\Http\DBModel;


use Illuminate\Database\Eloquent\Model;

class BodyTypeStrategy extends Model
{
    protected $table = "dodyTypeStrategys";
    public $timestamps = false;

    public function nutritionStrategies(){
        return $this->belongsToMany('App\Http\DBModel\NutritionStrategy');
    }
}