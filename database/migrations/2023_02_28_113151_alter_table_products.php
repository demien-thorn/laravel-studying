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
            $table->tinyInteger(column: 'new')->default(value: 0);
            $table->tinyInteger(column: 'hit')->default(value: 0);
            $table->tinyInteger(column: 'recommend')->default(value: 0);
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
            $table->dropColumn(columns: 'new');
            $table->dropColumn(columns: 'hit');
            $table->dropColumn(columns: 'recommend');
        });
    }
};
