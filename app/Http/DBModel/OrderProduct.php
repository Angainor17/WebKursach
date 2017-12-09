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
class OrderProduct extends Model
{
    protected $table = "order_product";
    public $timestamps = false;
}