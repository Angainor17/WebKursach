<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.12.2017
 * Time: 20:21
 */

namespace App\Http\DBModel;


use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 */
class Portion extends Model
{
    protected $table = "portions";
    public $timestamps = false;

    public function productStrategies(){
        return $this->belongsToMany('App\Http\DBModel\BodyTypeStrategy');
    }
}