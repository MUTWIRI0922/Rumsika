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
                Schema::create('enquiries', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('house_id');
                $table->string('client_ip')->nullable();
                $table->timestamps();

                $table->foreign('house_id')->references('id')->on('housedetails')->onDelete('cascade');
                 });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
