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
        Schema::create('houseviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('house_id')->index();
            $table->string('client_ip', 45)->nullable(); // IPv6 support
            $table->foreign('house_id')->references('id')->on('housedetails')->onDelete('cascade');
            $table->unique(['house_id', 'client_ip'], 'houseviews_unique'); // Ensure unique views per house and IP
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houseviews');
    }
};
