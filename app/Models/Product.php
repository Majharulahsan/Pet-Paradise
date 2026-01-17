<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',       // Changed from 'name' to 'title' to match your migration
        'description',
        'image',
        'category',
        'price',
        'quantity',    // Changed from 'stock' to 'quantity' to match your migration
    ];
    public function reviews()
{
    return $this->morphMany(Review::class, 'reviewable');
}
}