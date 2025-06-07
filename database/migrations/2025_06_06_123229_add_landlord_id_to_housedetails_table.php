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
          Schema::table('housedetails', function (Blueprint $table) {
        //$table->unsignedBigInteger('landlord_id')->nullable()->after('id');
         $table->foreign('landlord_id')->references('id')->on('landlords')->onDelete('cascade');
        });
        // Add the landlord_id column to the housedetails table
        // and set up a foreign key constraint to the landlords table
        // The foreign key will cascade on delete, meaning if a landlord is deleted
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('housedetails', function (Blueprint $table) {
        $table->dropForeign(['landlord_id']);
        $table->dropColumn('landlord_id');
        });
    }
};
