<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Define the fillable fields for the order
    protected $fillable = ['user_id', 'phone', 'address', 'total_price', 'status'];

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Many-to-many relationship with the products (via the pivot table)
    public function items()
    {
        return $this->belongsToMany(Product::class, 'order_items')->withPivot('quantity');
    }
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}
}
