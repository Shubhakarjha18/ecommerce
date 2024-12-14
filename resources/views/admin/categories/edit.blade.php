@extends('admin.layout')
@section('title', 'Edit')
@section('body')
<div class="max-w-4xl mx-auto mt-8 bg-gray-800 text-gray-100 p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6">Edit Category</h1>

    @if($errors->any())
        <div class="bg-red-600 text-gray-100 p-4 rounded-lg mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="cat_name" class="block text-sm font-medium mb-2">Category Name</label>
            <input 
                type="text" 
                id="cat_name" 
                name="cat_name" 
                value="{{ old('cat_name', $category->cat_name) }}" 
                class="w-full px-4 py-3 border border-gray-600 bg-gray-700 text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                required
            />
        </div>

        <div class="flex justify-end space-x-4">
            <a 
                href="{{ route('categories.index') }}" 
                class="bg-gray-600 px-4 py-2 rounded-lg hover:bg-gray-500 transition"
            >
                Cancel
            </a>
            <button 
                type="submit" 
                class="bg-blue-600 px-4 py-2 rounded-lg hover:bg-blue-500 transition"
            >
                Update
            </button>
        </div>
    </form>
</div>
@endsection
