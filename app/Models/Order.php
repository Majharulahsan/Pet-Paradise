<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'payment_method',
        'status',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address'
    ];

    /**
     * Relationship: An order has many items.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relationship: An order belongs to a user (optional).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}