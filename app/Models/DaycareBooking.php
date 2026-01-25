<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaycareBooking extends Model
{
    protected $fillable = [
        'user_id', 
        'pet_id', 
        'check_in', 
        'check_out', 
        'status', 
        'special_instructions'
    ];

    // Get the pet staying in daycare
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}