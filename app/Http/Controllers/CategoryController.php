<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display the list of categories.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cat_name' => 'required|string|max:255',
        ]);

        Category::create([
            'cat_name' => $request->cat_name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category added successfully!');
    }

    public function destroy($id)
{
    // Find the category by ID
    $category = Category::findOrFail($id);

    // Delete the category
    $category->delete();

    // Redirect back with a success message
    return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
}

public function edit($id)
{
    // Find the category to edit
    $category = Category::findOrFail($id);

    // Return the edit view
    return view('admin.categories.edit', compact('category'));
}

public function update(Request $request, $id)
{
    // Validate input
    $request->validate([
        'cat_name' => 'required|string|max:255',
    ]);

    // Find the category and update it
    $category = Category::findOrFail($id);
    $category->cat_name = $request->cat_name;
    $category->save();

    // Redirect back with a success message
    return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
}


}
