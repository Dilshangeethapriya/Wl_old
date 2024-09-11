<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom class for translucent background */
        .bg-translucent {
            background-color: rgba(255, 255, 255, 0.7); /* white background with 70% opacity */
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100"
      style="background-image: url('{{ asset('storage/bg1.jpg') }}'); background-size: cover;">
    <x-admin-navbar/>

    <main class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-4xl mt-6 px-6 py-4 bg-translucent shadow-md overflow-hidden sm:rounded-lg">
            <h1 class="text-center text-3xl font-bold mb-6 text-gray-700">Dashboard</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Inquiries Count -->
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Inquiries</h3>
                    <p class="text-gray-700">Total Inquiries: {{ $inquiriesCount }}</p>
                </div>

                <!-- Products Count -->
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Products</h3>
                    <p class="text-gray-700">Total Products: {{ $productsCount }}</p>
                </div>

                <!-- Reviews Count -->
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Reviews</h3>
                    <p class="text-gray-700">Total Reviews: {{ $reviewsCount }}</p>
                </div>

                <!-- Customers Count -->
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Customers</h3>
                    <p class="text-gray-700">Total Customers: {{ $customersCount }}</p>
                </div>

                <!-- Customers Count -->
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Orders</h3>
                    <p class="text-gray-700">Total Orders: {{ $orderCount }}</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
