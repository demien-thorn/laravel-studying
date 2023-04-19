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
    public function up(): void
    {
        Schema::create(table: 'comments', callback: function (Blueprint $table) {
            $table->id();
            $table->tinyInteger(column: 'sku_id');
            $table->string(column: 'username');
            $table->string(column: 'email');
            $table->string(column: 'password');
            $table->text(column: 'comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'comments');
    }
};