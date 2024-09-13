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

    <main class="min-h-screen flex flex-col items-center bg-transparent pt-6 sm:pt-0">
    <div class="w-full sm:max-w-4xl mt-6 px-6 py-4 .bg-translucentshadow-lg rounded-lg">
        <h1 class="text-center text-4xl font-extrabold mb-6 text-gray-800">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            

            <!-- Products Count -->
            <div class="bg-gradient-to-r  from-green-600 to-green-400 p-6 rounded-lg shadow-lg text-white">
                <h3 class="text-2xl font-semibold mb-3">Products</h3>
                <p class="text-lg">Total Products: <span class="font-bold">{{ $productsCount }}</span></p>
            </div>

            <!-- Reviews Count -->
            <div class="bg-gradient-to-r  from-green-600 to-green-400 p-6 rounded-lg shadow-lg text-white">
                <h3 class="text-2xl font-semibold mb-3">Reviews</h3>
                <p class="text-lg">Total Reviews: <span class="font-bold">{{ $reviewsCount }}</span></p>
            </div>

            <!-- Customers Count -->
            <div class="bg-gradient-to-r  from-green-600 to-green-400 p-6 rounded-lg shadow-lg text-white">
                <h3 class="text-2xl font-semibold mb-3">Customers</h3>
                <p class="text-lg">Total Customers: <span class="font-bold">{{ $customersCount }}</span></p>
            </div>

            <!-- Orders Count -->
            <div class="bg-gradient-to-r  from-green-600 to-green-400 p-6 rounded-lg shadow-lg text-white">
                <h3 class="text-2xl font-semibold mb-3">Orders</h3>
                <p class="text-lg">Total Orders: <span class="font-bold">{{ $orderCount }}</span></p>
            </div>
            <!-- Inquiries Count -->
            <div class="bg-gradient-to-r  from-green-600 to-green-400 p-6 rounded-lg shadow-lg text-white">
                <h3 class="text-2xl font-semibold mb-3">Inquiries</h3>
                <p class="text-lg">Total Inquiries: <span class="font-bold">{{ $inquiriesCount }}</span></p>
            </div>
            <div class="bg-gradient-to-r  from-green-600 to-green-400 p-6 rounded-lg shadow-lg text-white">
                <h3 class="text-2xl font-semibold mb-3">Call Back Requests</h3>
                <p class="text-lg">Total Requests: <span class="font-bold">{{ $callbackCount }}</span></p>
            </div>
        </div>
    </div>
</main>

</body>
</html>
