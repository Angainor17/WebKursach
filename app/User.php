<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Yajra\Datatables\Exception;

/**
 * @property mixed $products
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Http\DBModel\Product');
    }

    public function meals()
    {
        return $this->belongsToMany('App\Http\DBModel\Meal');
    }

    public function getTotalCost()
    {
        try {
            $sum = 0;
            foreach ($this->products()->get() as $product) {
                $sum = $sum + intval(floatval($product->cost) * (floatval(100 - $product->discount) / 100.0));
            }
        } catch (Exception $exception) {
            return 0;
        }
        return $sum;
    }
}
