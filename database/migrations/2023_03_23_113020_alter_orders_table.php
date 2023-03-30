<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This migration edits the "orders" table adding a "coupon_id" column
     * which is responsable for the usage of the coupons in the orders.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(table: 'orders', callback: function (Blueprint $table) {
            $table->unsignedInteger(column: 'coupon_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     * Drops the "coupon_id" column.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(table: 'orders', callback: function (Blueprint $table) {
            $table->dropColumn(columns: 'coupon_id');
        });
    }
};
