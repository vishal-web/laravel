<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->integer('product_id')->default(0);
            $table->string('firstname',255);
            $table->string('lastname',255);
            $table->string('email',255);
            $table->string('contact',20);
            $table->string('shipping_city',50);
            $table->string('shipping_state',50);
            $table->text('shipping_address1');
            $table->text('shipping_address2');
            $table->text('shipping_landmark');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /*
        id
        user_id
        product_id
        firstname
        lastname
        email
        contact
        shipping_city
        shipping_state
        shipping_address1
        shipping_address2
        shipping_landmak
        status
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}