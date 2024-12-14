@extends('admin.layout')
@section('title', 'Add New Category')
@section('body')

<

    <div class="max-w-6xl mx-auto mt-8 bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Categories</h1>

        <!-- Display Success Message -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Create Category Form -->
        <form action="{{ route('categories.store') }}" method="POST" class="flex items-center space-x-4 mb-6">
            @csrf
            <input 
                type="text" 
                name="cat_name" 
                placeholder="Enter category name" 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                required
            />
            <button 
                type="submit" 
                class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-6 py-3 rounded-lg shadow-lg font-semibold hover:from-blue-600 hover:to-indigo-600 transition"
            >
                + Add Category
            </button>
        </form>

        <!-- Display Categories -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($categories as $category)
                <div class="flex items-center justify-between bg-gray-700 text-gray-100 p-4 rounded-lg shadow">
                    <span class="font-semibold">{{ $category->cat_name }}</span>
                    <div class="flex items-center space-x-2">
                        <!-- Edit Button -->
                        <a 
                            href="{{ route('categories.edit', $category->id) }}" 
                            class="text-blue-400 hover:text-blue-600 transition"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </a>
        
                        <!-- Delete Button -->
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                class="text-red-400 hover:text-red-600 transition"
                                onclick="return confirm('Are you sure you want to delete this category?')"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a2 2 0 00-2 2v0a2 2h4a2 2 0 002-2m-4 0V3m4 0V3" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        
        
        
    </div>




@endsection