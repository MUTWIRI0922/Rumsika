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
        //
        Schema::create('Housedetails', function (Blueprint $table) {
            $table->id();
            $table->string('Type');
            $table->string('Location', 64);
            $table->text('Description');
            $table->integer('Rate');
            $table->string('image');
            $table->string('image_inside')->nullable();
            $table->string('Image_outside')->nullable();
            $table->text('Amenities')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
