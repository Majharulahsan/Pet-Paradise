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
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Who wrote it
        
        // This creates 'reviewable_id' and 'reviewable_type'
        // Allows reviewing a Product, an Appointment, or a Daycare stay
        $table->morphs('reviewable'); 
        
        $table->integer('rating'); // e.g., 1 to 5
        $table->text('comment')->nullable();
        $table->timestamps();
    });
}
};
