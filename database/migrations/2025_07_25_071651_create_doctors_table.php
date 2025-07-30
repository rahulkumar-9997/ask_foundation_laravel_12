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
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('doctor_name');
            $table->string('slug')->unique();
            $table->string('department')->nullable();
            $table->string('experience')->nullable();
            $table->string('location_area')->nullable();
            $table->text('short_content')->nullable();
            $table->string('image')->nullable();
            $table->longText('content')->nullable();
            $table->longText('role_in_ask_foundation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
