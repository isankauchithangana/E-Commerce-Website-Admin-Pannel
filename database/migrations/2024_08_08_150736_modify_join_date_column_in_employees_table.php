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
        Schema::table('emplooyees', function (Blueprint $table) {
            $table->dateTime('joinDate')->change(); // Change this to dateTime or date as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emplooyees', function (Blueprint $table) {
            //
        });
    }
};
