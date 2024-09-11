<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Callback Request</title>
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
    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 max-w-3xl">
        <div class="relative shadow-lg rounded-lg overflow-hidden">
            <div class="bg-orange-800 text-white px-6 py-4 relative">
                <!-- Back Button at the top-left corner -->
                <a href="{{ route('admin.inquiry.index') }}" 
                   class="absolute top-4 left-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md text-white hover:scale-105 focus:outline-none">
                   <img src="{{ asset('storage/arrow.png') }}" alt="Back" class="w-6 h-6 mr-2">
                </a>
                <h3 class="text-2xl font-semibold text-center">Callback Request No: {{$callback->id}}</h3>
            </div>

            <div class="px-6 py-4 border-b bg-translucent">
                <h2 class="text-xl font-semibold text-gray-800 mb-4"></h2>

                <div class="space-y-4">
                    <div class="flex justify-between">
                        <strong class="text-gray-700">Name:</strong>
                        <span class="text-gray-900">{{ $callback->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <strong class="text-gray-700">Phone:</strong>
                        <span class="text-gray-900">{{ $callback->phone }}</span>
                    </div>
                    <div class="flex justify-between">
                        <strong class="text-gray-700">Available Time:</strong>
                        <span class="text-gray-900">{{ $callback->time_from }} - {{ $callback->time_to }}</span>
                    </div>
                    <div class="flex justify-between">
                        <strong class="text-gray-700">Requested At:</strong>
                        <span class="text-gray-900">{{ $callback->created_at }}</span>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 flex justify-end bg-white border-t">
                <form method="POST" action="{{ route('admin.inquiry.callback.delete', $callback->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full mt-auto inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring ring-red-300">
                        Delete Request
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
