<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This migration creates a new table called "coupons"
     * which will be responsable for the coupons functional in our project.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(table: 'coupons', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'code', length: 8);
            $table->double(column: 'value');
            $table->unsignedTinyInteger(column: 'type')->default(value: 0);
            $table->unsignedInteger(column: 'currency_id')->nullable();
            $table->unsignedTinyInteger(column: 'only_once')->default(value: 0);
            $table->timestamp(column: 'expired_at')->nullable();
            $table->text(column: 'description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Drops table "coupons".
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(table: 'coupons');
    }
};
