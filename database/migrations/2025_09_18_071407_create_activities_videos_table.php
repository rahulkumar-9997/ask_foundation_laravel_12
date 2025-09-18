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
        Schema::create('activities_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('activities_id');
            $table->string('title')->nullable();
            $table->string('video_path')->nullable(); /*uploaded file*/
            $table->string('video_link')->nullable(); /*external link (YouTube etc.)*/
            $table->string('short_order')->default(0);
            $table->timestamps();
            $table->foreign('activities_id')->references('id')->on('activities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities_videos');
    }
};
