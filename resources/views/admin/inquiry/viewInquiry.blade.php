<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom class for translucent background */
        .bg-translucent {
            background-color: rgba(255, 255, 255, 0.7); /* white background with 80% opacity */
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased"
      style="background-image: url('{{ asset('storage/bg1.jpg') }}'); background-size: cover;">

    <div class="flex items-center justify-center min-h-screen my-20">
        <!-- Inquiry Container -->
        <div class="w-full max-w-4xl bg-translucent shadow-md rounded-lg overflow-hidden">
            <!-- Header with Back Button -->
            <div class=" text-white px-6 py-4 relative bg-orange-800">
                <!-- Back Button at the top-left corner -->
                <a href="{{ route('admin.inquiry.index') }}" 
                   class="absolute top-4 left-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md text-white hover:scale-105 focus:outline-none">
                   <img src="{{ asset('storage/arrow.png') }}" alt="Back" class="w-6 h-6 mr-2">
                </a>
                <h3 class="text-2xl font-semibold text-center">Inquiry No: {{$inquiry->ticketID}}</h3>
            </div>

            <!-- Content Area -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <p><strong>Name:</strong> {{$inquiry->name}}</p>
                    </div>
                    <div>
                        <p><strong>Email:</strong> {{$inquiry->email}}</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <p><strong>Phone:</strong> {{$inquiry->phone}}</p>
                    </div>
                    <div>
                        <p><strong>Created At:</strong> {{$inquiry->created_at}}</p>
                        <p><strong>Updated At:</strong> {{$inquiry->updated_at}}</p>
                    </div>
                </div>
               
                <div class="mb-6 p-4 bg-transparent border border-gray-400 rounded-lg shadow-sm">
                <div class="mb-6 text-center">
                    <h3 class="text-xl font-semibold">{{$inquiry->subject}}</h3>
                </div>
                     <p class="text-gray-600">{{ $inquiry->ticketText }}</p>
                 </div>
                <div class="mb-6">
                    <span class="inline-block px-4 py-2 text-lg font-semibold text-white
                        @if($inquiry->ticketStatus == 'New') bg-blue-600 
                        @elseif($inquiry->ticketStatus == 'In Progress') bg-yellow-500 
                        @elseif($inquiry->ticketStatus == 'Closed') bg-green-600 
                        @endif">
                        {{$inquiry->ticketStatus}}
                    </span>
                </div>
                <div class="mt-6">
                    <h3 class="text-xl font-semibold mb-4">Reply to Inquiry</h3>
                    <form method="POST" action="{{ route('admin.inquiry.reply', $inquiry->ticketID) }}">
                        @csrf
                        <div class="mb-4">
                            <label for="reply" class="block text-gray-700">Your Reply</label>
                            <textarea name="reply" id="reply" rows="4" value="{{ old('reply') }}" class="block w-full mt-1 rounded border-gray-300 text-gray-700 shadow-sm focus:ring-indigo-500" required></textarea>
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300">
                            Send Reply
                        </button>
                    </form>
                </div>

                <!-- Footer (Buttons) -->
                <div class="bg-transparent p-6 mt-5 flex justify-between items-end">
                    <div>
                        <form method="POST" action="{{ route('admin.inquiry.updateStatus', $inquiry->ticketID) }}">
                            @csrf
                            @method('PUT')
                            <label for="status" class="block text-gray-700 ">Change Status</label>
                            <select name="status" id="status" class="block w-full mt-1 rounded border-gray-300 text-gray-700 shadow-sm focus:ring-indigo-500">
                                <option value="New" {{ $inquiry->ticketStatus == 'New' ? 'selected' : '' }}>New</option>
                                <option value="In Progress" {{ $inquiry->ticketStatus == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Closed" {{ $inquiry->ticketStatus == 'Closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                            <button type="submit" class="mt-4 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300">
                                Update Status
                            </button>
                        </form>
                    </div>

                    @if($inquiry->ticketStatus == 'Closed')
                    <div>
                        <form method="POST" action="{{ route('admin.inquiry.delete', $inquiry->ticketID) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full mt-auto inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring ring-red-300">
                                Delete Inquiry
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
