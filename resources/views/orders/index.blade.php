@include('home.header')
@include('home.nav')

<!-- Main Heading -->
<h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Your Orders</h1>

<!-- Table Section -->
<div class="flex justify-center">
    <div class="overflow-x-auto w-full max-w-7xl">
        <table class="min-w-full table-auto bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-600">
                    <th class="px-4 py-2 text-left font-medium">Phone</th>
                    <th class="px-4 py-2 text-left font-medium">Address</th>
                    <th class="px-4 py-2 text-left font-medium">Item Name</th>
                    <th class="px-4 py-2 text-left font-medium">Quantity</th>
                    <th class="px-4 py-2 text-left font-medium">Price</th>
                    <th class="px-4 py-2 text-left font-medium">Ordered At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $orderItem)
                    <tr class="border-b border-gray-200">
                        <td class="px-4 py-2 text-gray-700">{{ $orderItem->order->phone }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $orderItem->order->address }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $orderItem->product->title }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $orderItem->quantity }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $orderItem->product->price }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $orderItem->order->created_at->format('d M, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('home.footer')
