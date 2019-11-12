<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartProducts extends Model
{
    
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cart_products';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id','product_name','product_price','product_qty','date','order_id'];
}
