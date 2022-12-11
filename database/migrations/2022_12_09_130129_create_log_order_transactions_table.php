<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_order_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->on('users')->references('id');
            $table->foreignId('order_id');
            $table->foreign('order_id')->on('orders')->references('id');
            $table->foreignId('product_id');
            $table->foreign('product_id')->on('products')->references('id');
            $table->integer('quantity')->default(0);
            $table->decimal('availed_price')->default(0)->comment('original price of the product');
            $table->decimal('total_price')->default(0)->comment('original price of the product * purchased quantity');
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
        Schema::dropIfExists('log_order_transactions');
    }
};
