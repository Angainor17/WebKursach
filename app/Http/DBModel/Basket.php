<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 18.11.2017
 * Time: 10:24
 */

namespace App\Http\DBModel;


use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 */
class Basket extends Model
{
    protected $table = "product_user";
    public $timestamps = false;

//    function products($userId){
//        $this->belongsTo('')
//    }
}