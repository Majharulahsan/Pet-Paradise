<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'user_id', 
        'pet_id', 
        'service_type', 
        'appointment_date', 
        'notes', 
        'status'
    ];

    /**
     * Relationship: An appointment belongs to a User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: An appointment is for a specific Pet.
     */
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }
    public function reviews()
{
    return $this->morphMany(Review::class, 'reviewable');
}
}