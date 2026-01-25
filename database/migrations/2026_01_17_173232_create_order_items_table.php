<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            // Link to the main order
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            // Link to the product
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            
            // We store name and price at the time of purchase in case they change later
            $table->string('product_name'); 
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};