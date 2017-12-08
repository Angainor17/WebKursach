<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 18.11.2017
 * Time: 10:30
 */

namespace App\Http\DBModel;


use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 */
class ProductTypeStrategy extends Model
{
    protected $table = "product_type_strategys";
    public $timestamps = false;

    public function bodyStrategys(){
        return $this->belongsToMany('App\Http\DBModel\BodyTypeStrategy');
    }
}