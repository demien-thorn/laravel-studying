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
        Schema::table(table: 'comments', callback: function (Blueprint $table) {
            $table->enum(column: 'moderation_status', allowed: [
                'declined',
                'on_moderation',
                'confirmed'
            ])->after(column: 'comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table(table: 'comments', callback: function (Blueprint $table) {
            $table->dropColumn(columns: 'moderation_status');
        });
    }
};
