<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'rating', 'comment', 'reviewable_id', 'reviewable_type'];

    /**
     * Get the parent reviewable model (Product or Appointment).
     */
    public function reviewable()
    {
        return $this->morphTo();
    }

    /**
     * Link back to the User who wrote it.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}