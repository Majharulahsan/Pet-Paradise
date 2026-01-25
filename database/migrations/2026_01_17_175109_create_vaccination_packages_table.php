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
    Schema::create('vaccination_packages', function (Blueprint $table) {
        $table->id();
        $table->string('name');          // e.g., "Complete Puppy Package"
        $table->text('description');     // List of vaccines included
        $table->decimal('price', 8, 2);  // Bundle price
        $table->string('pet_type');      // Dog, Cat, etc.
        $table->timestamps();
    });
}
};
