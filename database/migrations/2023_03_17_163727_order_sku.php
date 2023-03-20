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
        Schema::create(table: 'order_sku', callback: function (Blueprint $table) {
            $table->id();
            $table->integer(column: 'order_id');
            $table->integer(column: 'sku_id');
            $table->integer(column: 'count');
            $table->double(column: 'price');
            $table->timestamps();
        });

        Schema::dropIfExists(table: 'order_product');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create(table: 'order_product', callback: function (Blueprint $table) {
            $table->id();
            $table->integer(column: 'order_id');
            $table->integer(column: 'product_id');
            $table->integer(column: 'count');
            $table->double(column: 'price');
            $table->timestamps();
        });

        Schema::dropIfExists(table: 'order_sku');
    }
};
