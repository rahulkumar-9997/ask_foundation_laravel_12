<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // database/migrations/[timestamp]_create_pages_table.php
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('main_image')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->longText('content')->nullable();
            $table->json('page_builder_data')->nullable(); 
            $table->string('route_name')->unique()->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('template')->default('default');
            $table->string('layout_type')->default('simple');
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('pages')->onDelete('cascade');
        });

        Schema::create('page_components', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page_id');
            $table->string('component_type'); // slider, text, grid, image, etc.
            $table->json('component_data'); // Stores component specific data
            $table->integer('order')->default(0);
            $table->string('section')->default('content'); // header, content, footer, sidebar
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
        Schema::dropIfExists('page_components');
    }
}
