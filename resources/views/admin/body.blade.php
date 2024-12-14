<div class="page-content">
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            <!-- Total Admins Card -->
            <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                <h2 class="text-lg font-semibold text-gray-700">Total Admins</h2>
                <p class="text-xl font-semibold text-blue-500">{{ $totalAdmins }}</p>
            </div>

            <!-- Total Users Card -->
            <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                <h2 class="text-lg font-semibold text-gray-700">Total Users</h2>
                <p class="text-xl font-semibold text-green-500">{{ $totalUsers }}</p>
            </div>

            <!-- Total Orders Card -->
            <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                <h2 class="text-lg font-semibold text-gray-700">Total Orders</h2>
                <p class="text-xl font-semibold text-yellow-500">{{ $totalOrders }}</p>
            </div>

            <!-- Total Categories Card -->
            <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                <h2 class="text-lg font-semibold text-gray-700">Total Categories</h2>
                <p class="text-xl font-semibold text-purple-500">{{ $totalCategories }}</p>
            </div>

            <!-- Total Products Card (if you want to add this) -->
            <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                <h2 class="text-lg font-semibold text-gray-700">Total Products</h2>
                <p class="text-xl font-semibold text-teal-500">{{ $totalProducts }}</p>
            </div>
        </div>
    </div>
</div>
