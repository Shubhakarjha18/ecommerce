<?php

// app/Http/Controllers/AdminOrderController.php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // Display all orders
    public function index()
    {
        // Fetch all orders with order items and user details
        $orders = Order::with('orderItems')->get();

        return view('admin.orders.index', compact('orders'));
    }

    // Update the status of an order
    public function updateStatus(Request $request, Order $order)
    {
        // Validate the status
        $request->validate([
            'status' => 'required|in:pending,completed,shipped,canceled',
        ]);

        // Update the status
        $order->status = $request->status;
        $order->save();

        // Redirect back with a success message
        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
    }
}
