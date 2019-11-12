
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_order';

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
    protected $fillable = ['customer_id','order_id'];
}






