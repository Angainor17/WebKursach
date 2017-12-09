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
class Meal extends Model
{
    protected $table = "meals";
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('App\Http\User');
    }
}