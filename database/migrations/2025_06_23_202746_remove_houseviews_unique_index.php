<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('houseviews', function (Blueprint $table) {
             $table->dropUnique('houseviews_unique'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('houseviews', function (Blueprint $table) {
            //
              $table->unique(['house_id', 'client_ip'], 'houseviews_unique');
        });
    }
};
