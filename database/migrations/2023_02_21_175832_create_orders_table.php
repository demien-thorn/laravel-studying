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
        Schema::create(table: 'orders', callback: function (Blueprint $table) {
            $table->id();
            $table->tinyInteger(column: 'status')->default(value: 0);
            $table->string(column: 'name')->nullable();
            $table->string(column: 'phone')->nullable();
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
        Schema::dropIfExists(table: 'orders');
    }
};

