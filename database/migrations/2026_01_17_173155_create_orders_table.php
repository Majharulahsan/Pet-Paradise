<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Connects to your existing users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Financial details matching your Order model
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_method')->default('cash_on_delivery');
            $table->string('status')->default('pending'); // e.g., pending, completed, cancelled
            
            // Customer contact info for the specific delivery
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->text('shipping_address');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};