<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsedCoupons extends Model
{
    //

    protected $table = 'used_coupon';

    protected $primaryKey = 'id';


    protected $fillable = ['coupon_id','customer_id'];
}
