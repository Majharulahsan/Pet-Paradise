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
    Schema::create('daycare_bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('pet_id')->constrained()->onDelete('cascade');
        $table->dateTime('check_in');
        $table->dateTime('check_out');
        $table->string('status')->default('booked');
        
        // MAKE SURE THIS LINE IS EXACTLY LIKE THIS:
        $table->text('special_instructions')->nullable(); 
        
        $table->timestamps();
    });
}
};
