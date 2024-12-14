@include('home.header')
@include('home.nav')

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Your Cart</h2>

        @if($cartItems->isEmpty())
            <p class="text-gray-500">Your cart is empty.</p>
        @else
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-6 text-left">Product</th>
                            <th class="py-3 px-6 text-left">Price</th>
                            <th class="py-3 px-6 text-left">Quantity</th>
                            <th class="py-3 px-6 text-right">Total</th>
                            <th class="py-3 px-6 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $cartItem)
                            <tr class="border-b">
                                <td class="py-3 px-6 flex items-center">
                                    <img src="{{ asset($cartItem->product->image) }}" alt="{{ $cartItem->product->title }}" class="w-16 h-16 object-cover rounded-lg mr-4">
                                    <span>{{ $cartItem->product->title }}</span>
                                </td>
                                <td class="py-3 px-6">{{ $cartItem->product->price }} USD</td>
                                <td class="py-3 px-6">{{ $cartItem->quantity }}</td>
                                <td class="py-3 px-6 text-right">{{ $cartItem->product->price * $cartItem->quantity }} USD</td>
                                <td class="py-3 px-6 text-center">
                                    <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Total Price Section -->
            <div class="mt-6 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Total Price:</h3>
                <p class="text-xl font-semibold text-blue-600">{{ $totalPrice }} USD</p>
            </div>

            <!-- Order Details Form -->
            <div class="mt-8 bg-white p-6 shadow-md rounded-lg">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Place Your Order</h3>
                <form action="{{ route('cart.placeOrder') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="w-full p-3 border border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4">
                            <label for="address" class="block text-gray-700">Address</label>
                            <textarea name="address" id="address" rows="3" class="w-full p-3 border border-gray-300 rounded-md" required></textarea>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3 bg-blue-600 text-gray-700 rounded-md font-semibold">Place Order</button>
                </form>
            </div>

        @endif
    </div>
</section>

@include('home.footer')
