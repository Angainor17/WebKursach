<?php

namespace App\Http\DBModel;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 */
class Article extends Model
{
    protected $table = "articles";
    public $timestamps = false;

    public function articles()
    {
        return $this->belongsToMany('App\Http\DBModel\Product');
    }
}
