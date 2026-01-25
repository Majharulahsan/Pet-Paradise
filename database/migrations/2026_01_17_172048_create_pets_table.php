<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            // This links the pet to a user. If a user is deleted, the pet record is also removed.
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->string('name');             // Pet's name
            $table->string('species');          // Dog, Cat, etc.
            $table->string('breed')->nullable(); // Optional breed info
            $table->date('birth_date')->nullable();
            $table->timestamps();               // created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};