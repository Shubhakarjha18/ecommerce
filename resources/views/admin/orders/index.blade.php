@extends('admin.layout')
@section('title', 'Orders')
@section('body')
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">All Orders</h1>

        @if(session('success'))
            <div class="mb-4 text-green-500">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-gray-600">
                        <th class="px-4 py-2 text-left font-medium">User</th>
                        <th class="px-4 py-2 text-left font-medium">Phone</th>
                        <th class="px-4 py-2 text-left font-medium">Address</th>
                        <th class="px-4 py-2 text-left font-medium">Item Name</th>
                        <th class="px-4 py-2 text-left font-medium">Quantity</th>
                        <th class="px-4 py-2 text-left font-medium">Price</th>
                        <th class="px-4 py-2 text-left font-medium">Status</th>
                        <th class="px-4 py-2 text-left font-medium">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        @foreach ($order->orderItems as $orderItem)
                            <tr class="border-b border-gray-200">
                                <td class="px-4 py-2 text-gray-700">{{ $order->user->name }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $order->phone }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $order->address }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $orderItem->product->title }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $orderItem->quantity }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $orderItem->product->price }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ ucfirst($order->status) }}</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                                        @csrf
                                        <select name="status" class="form-select bg-white border border-gray-300 rounded p-2">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="canceled" {{ $order->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                                        </select>
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Update</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
