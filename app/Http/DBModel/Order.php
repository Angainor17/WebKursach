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
class Order extends Model
{
    protected $table = "orders";
    public $timestamps = false;

    public function products(){
        return $this->belongsToMany('App\Http\DBModel\Product');
    }

    public function orders(){
        return $this->belongsToMany('App\Http\DBModel\Order');
    }
}