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
        Schema::create(table: 'skus', callback: function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger(column: 'product_id');
            $table->unsignedInteger(column: 'count')->default(value: 0);
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
        Schema::dropIfExists(table: 'skus');
    }
};
