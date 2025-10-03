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
        Schema::create('donations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token', 40)->unique();
            $table->decimal('amount', 12, 2);
            $table->string('currency', 10)->default('INR');
            $table->string('salutation', 20)->nullable();
            $table->string('name');
            $table->string('pan_number', 20)->nullable();
            $table->string('pan_image')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile', 15)->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->string('payment_status')->default('pending'); // pending / success / failed
            $table->string('razorpay_payment_id')->nullable();
            $table->string('razorpay_order_id')->nullable();
            $table->string('razorpay_signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
