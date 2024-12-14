<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add a product to the cart
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
    
        $product = Product::findOrFail($productId);
    
        if (Auth::check()) {
            $user = Auth::user();
    
            $cartItem = Cart::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->first();
    
            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }
        } else {
            $cart = session()->get('cart', []);
    
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                $cart[$productId] = [
                    'title' => $product->title,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'image' => $product->image,
                ];
            }
    
            session()->put('cart', $cart);
        }
    
        return redirect()->back()->with('success', 'Product added to cart!');
    }
    
/**
 * Get total cart count for authenticated users or guests.
 */
private function getCartCount()
{
    if (Auth::check()) {
        return Cart::where('user_id', Auth::id())->count();
    }

    $cart = session()->get('cart', []);
    return count($cart);
}


    // View the user's cart
    public function viewCart()
    {
        if (Auth::check()) {
            // For logged-in users
            $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        } else {
            // For guests (session-based cart)
            $cart = session()->get('cart', []);
            $cartItems = collect($cart)->map(function ($item, $id) {
                return (object) [
                    'product' => (object) [
                        'id' => $id,
                        'title' => $item['title'],
                        'price' => $item['price'],
                        'image' => $item['image'],
                    ],
                    'quantity' => $item['quantity'],
                ];
            });
        }
    
        // Calculate total price
        $totalPrice = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->product->price * $item->quantity);
        }, 0);
    
        return view('cart.index', compact('cartItems', 'totalPrice'));
    }
    
    // Remove a product from the cart
    public function removeFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);

        // Ensure that the cart item belongs to the logged-in user
        if ($cartItem->user_id !== Auth::id()) {
            return redirect()->route('cart.view')->with('error', 'You cannot remove this item from the cart.');
        }

        // Delete the cart item
        $cartItem->delete();

        return redirect()->route('cart.view')->with('success', 'Product removed from cart.');
    }

    public function placeOrder(Request $request)
    {
        // Validate the request fields
        $request->validate([
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        // Get the user's cart items (cart related to the authenticated user)
        $cartItems = auth()->user()->cart;  // Using cart model for the user

        // Check if the user has any items in the cart
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty. Please add items before placing an order.');
        }

        // Calculate the total price from the cart items
        $totalPrice = $cartItems->sum(function ($cart) {
            // Ensure that each cart item has the product and quantity
            return $cart->product->price * $cart->quantity;
        });

        // Create the order
        $order = Order::create([
            'user_id' => auth()->id(), // Associate order with the user
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => $totalPrice,
        ]);

        // Associate cart items with the order
        foreach ($cartItems as $cart) {
            // Assuming the order_items pivot table exists
            $order->items()->attach($cart->product_id, ['quantity' => $cart->quantity]);
        }

        // Optionally, clear the user's cart after placing the order
        auth()->user()->cart()->delete();

        // Redirect to a page after placing the order
        return redirect()->route('dashboard')->with('success', 'Your order has been placed successfully!');
    }
    
    public function view_orders()
    {
        $user = auth()->user();  // Get the logged-in user
        
        // Fetch all order items where the related order belongs to the logged-in user
        $orderItems = OrderItem::with('order')
            ->whereHas('order', function($query) use ($user) {
                $query->where('user_id', $user->id); // Assuming `user_id` exists in `orders` table
            })
            ->get();

        return view('orders.index', compact('orderItems'));
    }
}

