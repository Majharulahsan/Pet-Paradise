<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pet extends Model
{
    // These fields are allowed to be filled when creating a new Pet
    protected $fillable = ['user_id', 'name', 'species', 'breed', 'birth_date'];

    /**
     * Relationship: A Pet belongs to a User.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}