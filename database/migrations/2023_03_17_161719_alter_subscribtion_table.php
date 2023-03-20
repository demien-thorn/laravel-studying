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
        Schema::table(table: 'subscriptions', callback: function (Blueprint $table) {
            $table->dropColumn(columns: 'product_id');
            $table->unsignedInteger(column: 'sku_id')->after(column: 'status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(table: 'subscriptions', callback: function (Blueprint $table) {
            $table->dropColumn(columns: 'sku_id');
            $table->unsignedInteger(column: 'product_id')->after(column: 'status');
        });
    }
};
