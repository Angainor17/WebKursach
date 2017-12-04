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
 * @property mixed $users
 */
class Product extends Model
{
    protected $table = "Product";
    public $timestamps = false;

    public function users(){
        return $this->belongsToMany('App\User');
    }
}