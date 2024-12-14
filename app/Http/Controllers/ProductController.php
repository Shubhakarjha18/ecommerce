<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('products'), $imageName);
            $imagePath = 'products/' . $imageName;
        }

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;
        $product->image = $imagePath;
        $product->save();

        return redirect()->route('products.create')->with('success', 'Product added successfully!');
    }
    
    public function index()
{
    $products = Product::all();  // Assuming you have a category relationship
    return view('admin.products.index', compact('products'));
}


public function edit(Product $product)
{
    $categories = Category::all();  // Get all categories for the dropdown
    return view('admin.products.edit', compact('product', 'categories'));
}
public function update(Request $request, Product $product)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'category' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Update product information
    $product->title = $request->title;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->quantity = $request->quantity;
    $product->category = $request->category;

    // Check if an image is uploaded and update it
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('products'), $imageName);
        $product->image = 'products/' . $imageName;
    }

    $product->save();

    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
}
public function destroy(Product $product)
{
    // Delete the image if it exists
    if ($product->image && file_exists(public_path($product->image))) {
        unlink(public_path($product->image));
    }

    // Delete the product record
    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
}
public function search(Request $request)
{
    $searchQuery = $request->query('search');
    
    $products = Product::when($searchQuery, function ($query, $searchQuery) {
        return $query->where('title', 'like', '%' . $searchQuery . '%')
                     ->orWhere('category', 'like', '%' . $searchQuery . '%');
    })->get();

    $categories = Category::all();

    return view('admin.products.index', compact('products', 'categories'));
}
public function show(Product $product)
{
    return view('home.products.show', compact('product'));
}


}
