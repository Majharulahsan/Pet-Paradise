<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::create('vaccinations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pet_id')->constrained()->onDelete('cascade');
        // This links the specific shot to the package the user bought
        $table->foreignId('package_id')->nullable()->constrained('vaccination_packages'); 
        $table->string('vaccine_name'); 
        $table->date('administered_at');
        $table->date('next_due_date');   
        $table->timestamps();
    });
}
};
