<?php

// app/Models/OrderItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Set the table name if it doesn't follow the convention
    protected $table = 'order_items';

    // Define fillable properties for mass assignment
    protected $fillable = ['order_id', 'product_id', 'quantity'];

    /**
     * Get the order that owns the order item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product that is associated with the order item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

