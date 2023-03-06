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
            $table->string(column: 'name_ru')->nullable()->after(column: 'name');
            $table->text(column: 'description_ru')->nullable()->after(column: 'description');
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
            $table->dropColumn(columns: ['name_ru', 'description_ru']);
        });
    }
};
