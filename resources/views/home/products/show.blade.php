@include('home.header')
@include('home.nav')

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Product Image Section -->
            <div class="flex justify-center items-center">
                <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" class="max-w-full h-96 object-contain rounded-lg shadow-lg">
            </div>

            <!-- Product Details Section -->
            <div class="space-y-6">
                <!-- Product Title -->
                <h1 class="text-4xl font-bold text-gray-800">{{ $product->title }}</h1>

                <!-- Product Description -->
                <div class="text-lg text-gray-700">
                    <p>{{ $product->description }}</p>
                </div>

                <!-- Price and Category Section -->
                <div class="flex justify-between items-center">
                    <p class="text-3xl font-semibold text-blue-600">{{ $product->price }} USD</p>
                    <p class="text-sm text-gray-500">Category: <span class="font-semibold text-gray-700">{{ $product->category }}</span></p>
                </div>

                <!-- Availability -->
                <div class="text-sm text-gray-500">
                    <p>Availability: <span class="font-semibold text-green-600">{{ $product->quantity }} available</span></p>
                </div>

                <!-- Action Buttons (Add to Cart & Wishlist) -->
                <div class="flex space-x-4 mt-4">
                    <button class="bg-gray-200 text-gray-800 py-3 px-8 rounded-lg shadow-md hover:bg-gray-300 focus:outline-none transition duration-300 w-full sm:w-auto">Add to Cart</button>
                    <button class="bg-gray-200 text-gray-800 py-3 px-8 rounded-lg shadow-md hover:bg-gray-300 focus:outline-none transition duration-300 w-full sm:w-auto">Wishlist</button>
                </div>
            </div>
        </div>
    </div>
</section>

@include('home.footer')
