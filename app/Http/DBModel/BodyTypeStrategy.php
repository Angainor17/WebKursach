<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 18.11.2017
 * Time: 10:28
 */

namespace App\Http\DBModel;


use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 */
class BodyTypeStrategy extends Model
{
    protected $table = "body_type_strategys";
    public $timestamps = false;

    public function productStrategies(){
        return $this->belongsTo('App\Http\DBModel\ProductTypeStrategy');
    }

    public function portions(){
        return $this->belongsToMany('App\Http\DBModel\Portion');
    }
}