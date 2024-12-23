@extends('admin.layout')
@section('title','Add New Product')
@section('body')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container mt-3">
        <div class="bg-white shadow rounded-lg">
            <div class="bg-blue-500 text-white rounded-t-lg p-4">
                <h2 class="mb-0">Add New Product</h2>
            </div>
            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="p-6">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Product Name -->
                        <div>
                            <label for="title" class="block text-yellow-100">Product Name</label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-200" 
                                required>
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-gray-700">Price</label>
                            <input 
                                type="number" 
                                name="price" 
                                id="price" 
                                class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-200" 
                                required>
                        </div>

                        <!-- Quantity -->
                        <div>
                            <label for="quantity" class="block text-gray-700">Quantity</label>
                            <input 
                                type="number" 
                                name="quantity" 
                                id="quantity" 
                                class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-200" 
                                required>
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-gray-700">Category</label>
                            <select 
                                name="category" 
                                id="category" 
                                class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-200" 
                                required>
                                <option value="" disabled selected>Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->cat_name }}">{{ $category->cat_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="sm:col-span-2">
                            <label for="description" class="block text-gray-700">Description</label>
                            <textarea 
                                name="description" 
                                id="description" 
                                rows="4" 
                                class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-200" 
                                required></textarea>
                        </div>

                        <!-- Product Image -->
                        <div class="sm:col-span-2">
                            <label for="image" class="block text-gray-700">Product Image</label>
                            <input 
                                type="file" 
                                name="image" 
                                id="image" 
                                class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-200" 
                                accept="image/*" 
                                required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full bg-blue-600 text-gray-700 rounded-md px-4 py-2 hover:bg-gray-600 transition">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
