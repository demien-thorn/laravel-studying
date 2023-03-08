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
        Schema::create(table: 'currencies', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'code');
            $table->string(column: 'symbol');
            $table->tinyInteger(column: 'is_main')->default(value: 0);
            $table->double(column: 'rate')->default(value: 0);
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
        Schema::dropIfExists(table: 'currencies');
    }
};
