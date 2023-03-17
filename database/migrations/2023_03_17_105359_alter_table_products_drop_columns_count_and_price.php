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
        Schema::table(table: 'products', callback: function (Blueprint $table) {
            $table->dropColumn(columns: ['count', 'price']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(table: 'products', callback: function (Blueprint $table) {
            $table->integer(column: 'count')->default(value: 0);
            $table->double(column: 'price')->default(value: 0);
        });
    }
};
