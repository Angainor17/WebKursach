<?php
/**
 * Created by PhpStorm.
 * User: angai
 * Date: 18.11.2017
 * Time: 10:24
 */

namespace App\Http\DBModel;


use Illuminate\Database\Eloquent\Model;

class ArticleProduct extends Model
{
    protected $table = "article_product";
    public $timestamps = false;
}