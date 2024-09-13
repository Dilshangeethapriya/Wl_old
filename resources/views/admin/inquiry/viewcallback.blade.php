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
            background-color: rgba(255, 255, 255, 0.8); /* white background with 80% opacity */
        }

           /* Enabled button style */
           .btn-enabled {
            background-color:  #dc2626; /* red background */
            border-color:  #dc2626; /* red border */
            color: #ffffff; /* white text */
        }
        .btn-enabled:hover {
            background-color: #f87171; /* dark red on hover */
            border-color:  #f87171; /* dark red border on hover */
        }
        /* Disabled button style */
        .btn-disabled {
            background-color: #d1d5db; /* light gray background */
            border-color: #d1d5db; /* light gray border */
            color: #6b7280; /* gray text */
            cursor: not-allowed; /* not-allowed cursor */
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
                    <div class="flex justify-between">
                        <strong class="text-gray-700">Status:</strong>
                        <span class="font-bold @if($callback->status == 'Pending') text-blue-500 
                        @elseif($callback->status == 'In Progress') text-yellow-500 
                        @elseif($callback->status == 'Failed') text-red-500
                        @elseif($callback->status == 'Completed') text-green-600 
                        @endif">{{ $callback->status}}</span>
                    </div>
                </div>
            </div>
            
            <div class="px-6 py-4 flex items-center bg-white border-t space-x-4">
                <!-- Update Status Form -->
                <form method="POST" action="{{ route('admin.inquiry.callback.updateStatus', $callback->id) }}" class="flex flex-1 space-x-4 items-center">
                    @csrf
                    @method('PUT')

                    <!-- Dropdown to select status -->
                    <div class="flex-1">
                        <select id="status" name="status" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:ring focus:ring-opacity-50">
                            <option value="Pending" {{ $callback->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ $callback->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Failed" {{ $callback->status == 'Failed' ? 'selected' : '' }}>Failed</option>
                            <option value="Completed" {{ $callback->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <!-- Update Status button -->
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300">
                        Update Status
                    </button>
                </form>

                <!-- Delete Request Form -->
                <form method="POST" action="{{ route('admin.inquiry.callback.delete', $callback->id) }}" class="flex-shrink-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-red-700 focus:ring ring-red-300
                            @if($callback->status == 'Completed' || $callback->status == 'Failed') btn-enabled @else btn-disabled @endif"
                            @if($callback->status != 'Completed' && $callback->status != 'Failed') disabled @endif>
                        Delete Request
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
