<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    protected $fillable = ['pet_id', 'package_id', 'vaccine_name', 'administered_at', 'next_due_date'];

    // Relationship: Link back to the Pet
    public function pet() {
        return $this->belongsTo(Pet::class);
    }
}