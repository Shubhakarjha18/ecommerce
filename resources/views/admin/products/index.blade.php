@extends('admin.layout') <!-- If you have an admin layout -->
@section('title', 'View Product')
@section('body')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">All Products</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-500 text-white">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
           <!-- Search Form -->
    <div class="mb-4">
        <form action="{{ route('products.search') }}" method="GET">
            <div class="flex space-x-4">
                <!-- Search by Title or Category -->
                <input type="text" name="search" id="search" class="p-2 border border-gray-300 rounded-md" placeholder="Search by Title or Category" value="{{ request('search') }}">

                <!-- Search Button -->
                <button type="submit" class="bg-yellow-500 text-black p-2 rounded-md hover:bg-yellow-600">Search</button>

            </div>
        </form>
    </div>
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-6 text-left">Title</th>
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-left">Price</th>
                    <th class="py-3 px-6 text-left">Quantity</th>
                    <th class="py-3 px-6 text-left">Category</th>
                    <th class="py-3 px-6 text-left">Image</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr class="border-b">
                        <td class="py-3 px-6">{{ $product->title }}</td>
                        <td class="py-3 px-6">{{ $product->description }}</td>
                        <td class="py-3 px-6">{{ $product->price }}</td>
                        <td class="py-3 px-6">{{ $product->quantity }}</td>
                        <td class="py-3 px-6">{{ $product->category}}</td>
                        <td class="py-3 px-6">
                            <img src="{{ asset($product->image) }}" alt="Product Image" class="w-20 h-20 object-cover">
                        </td>
                        <td class="py-3 px-6 text-center">
                            <a href="{{ route('products.edit', $product) }}" class="text-blue-500 hover:underline">Edit</a> | 
                            <form action="{{ route('products.delete', $product) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
