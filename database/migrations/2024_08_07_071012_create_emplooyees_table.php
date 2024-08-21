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
        Schema::create('emplooyees', function (Blueprint $table) {
            $table->id('userId');
            $table->string('firstName', 25);
            $table->string('lastName', 25);
            $table->string('NIC', 15);
            $table->string('address', 500);
            $table->string('pNo', 15);
            $table->string('joinDate', 10);
            $table->string('email', 50);
            $table->string('password', 500);
            $table->string('userRole', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emplooyees');
    }
};
