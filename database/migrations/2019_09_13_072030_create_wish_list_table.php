<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_wish_list', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('customer_id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('product'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_wish_list');
    }
}
