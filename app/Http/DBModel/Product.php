<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 18.11.2017
 * Time: 10:26
 */

namespace App\Http\DBModel;


use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
  */
class Product extends Model
{
    protected $table = "products";
    public $timestamps = false;

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function articles(){
        return $this->belongsToMany('App\Http\DBModel\Article');
    }

    public function orders(){
        return $this->belongsToMany('App\Http\DBModel\Order');
    }
}