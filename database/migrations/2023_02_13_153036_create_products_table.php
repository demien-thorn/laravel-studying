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
        Schema::create(table: 'products', callback: function (Blueprint $table) {
            $table->id();
            $table->integer(column: 'category_id');
            $table->string(column: 'name');
            $table->string(column: 'code');
            $table->text(column: 'description')->nullable();
            $table->text(column: 'image')->nullable();
            $table->double(column: 'price')->default(value: 0);
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
        Schema::dropIfExists(table: 'products');
    }
};
