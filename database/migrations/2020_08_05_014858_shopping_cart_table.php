<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShoppingCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ShoppingCart', function(Blueprint $table){
            $table->id();
            $table->foreignId('user_id')->constrained('users','id');
            $table->string('product');
            $table->string('status'); //purchased or pending
            $table->double('amount', 10, 2);
            $table->string('payment_mode')->nullable(); //item payment type
            $table->text('description')->nullable(); //item description
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ShoppingCart');
    }
}
