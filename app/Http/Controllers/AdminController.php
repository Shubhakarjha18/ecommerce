<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;  // Assuming you also want the total product count
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Get the total count of admins, users, orders, categories, and products
        $totalAdmins = User::where('usertype', 'admin')->count(); // For admin users
        $totalUsers = User::where('usertype', 'user')->count(); // For regular users
        $totalOrders = Order::count();
        $totalCategories = Category::count();
        $totalProducts = Product::count(); // Assuming you have a Product model

        // Pass the data to the view
        return view('admin.dashboard', compact('totalAdmins', 'totalUsers', 'totalOrders', 'totalCategories', 'totalProducts'));
    }
}
