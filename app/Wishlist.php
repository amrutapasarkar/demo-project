<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    //
    protected $table = 'user_wish_list';

    protected $primaryKey = 'id';

    protected $fillable = ['customer_id','product_id'];

    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }
}
