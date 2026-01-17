<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            // Links to the owner and the specific pet
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pet_id')->constrained()->onDelete('cascade');
            
            // Appointment Details
            $table->string('service_type'); // Grooming, Vet, Health Checkup
            $table->dateTime('appointment_date');
            $table->text('notes')->nullable(); // Special instructions from the owner
            
            // Status Management
            $table->string('status')->default('scheduled'); // scheduled, completed, cancelled
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
