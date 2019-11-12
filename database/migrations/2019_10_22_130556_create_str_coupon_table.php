<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStrCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::unprepared("CREATE PROCEDURE Str_Coupon(IN var_title varchar(255),IN var_code int(10),IN var_type varchar(20),var_discount int(20))
        BEGIN
            INSERT INTO coupons(title,code,type,discount) VALUES(var_title,var_code,var_type,var_discount);
            END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS Str_Coupon');
            //
    
    }
}
