<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Inquiries & Callbacks</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-translucent {
            background-color: rgba(255, 255, 255, 0.7); 
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100"
      style="background-image: url('{{ asset('storage/bg1.jpg') }}'); background-size: cover;">
    <x-admin-navbar/>

    <h1 class="font-bold cursor-pointer text-3xl text-center my-8">Inquiry Management</h1>


    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-transparent">
        <div class="w-full sm:max-w-4xl mt-6 px-6 py-4 bg-translucent shadow-md overflow-hidden sm:rounded-lg">
          
            <h2 class="text-center text-2xl font-semibold mb-5 text-gray-700">Customer Inquiries</h2>

            <div class="flex flex-col space-y-3">
                <div class="grid grid-cols-4 gap-4 bg-gray-200 p-3 rounded-t-lg text-gray-600">
                    <div class="text-left"><strong>Name</strong></div>
                    <div class="text-left"><strong>Subject</strong></div>
                    <div class="text-left"><strong>Date and Time</strong></div>
                    <div class="text-left"><strong>Status</strong></div>
                </div>
                @foreach($inquiries as $inquiry)
                <a href="{{ route('admin.inquiry.viewInquiry', $inquiry->ticketID) }}" class="hover:bg-gray-50">
                    <div class="grid grid-cols-4 gap-4 p-3 border-b border-gray-300 text-gray-700">
                        <div class="text-left">{{ $inquiry->name }}</div>
                        <div class="text-left">{{ $inquiry->subject }}</div>
                        <div class="text-left">{{ $inquiry->created_at }}</div>
                        <div class="text-left font-semibold
                            @if($inquiry->ticketStatus == 'New') text-blue-600 
                            @elseif($inquiry->ticketStatus == 'In Progress') text-yellow-500 
                            @elseif($inquiry->ticketStatus == 'Closed') text-green-600 
                            @endif">
                            {{$inquiry->ticketStatus}}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="mt-5">
            {{ $inquiries->links() }}
            </div>
        </div>

       
        <div class="w-full sm:max-w-4xl my-16 px-6 py-4 bg-translucent shadow-md overflow-hidden sm:rounded-lg">
            <h2 class="text-center text-2xl font-semibold mb-5 text-gray-700">Callback Requests</h2>

            <div class="flex flex-col space-y-3">
                <div class="grid grid-cols-4 gap-4 bg-gray-200 p-3 rounded-t-lg text-gray-600">
                    <div class="text-left"><strong>Name</strong></div>
                    <div class="text-left"><strong>Phone</strong></div>
                    <div class="text-left"><strong>Time Range</strong></div>
                    <div class="text-left"><strong>Status</strong></div>
                </div>
                @foreach($callbackRequests as $callback)
                <a href="{{ route('admin.inquiry.viewCallback', $callback->id) }}" class="hover:bg-gray-50">
                    <div class="grid grid-cols-4 gap-4 p-3 border-b border-gray-300 text-gray-700">
                        <div class="text-left">{{ $callback->name }}</div>
                        <div class="text-left">{{ $callback->phone }}</div>
                        <div class="text-left">{{ $callback->time_from }} - {{ $callback->time_to }}</div>
                        <div class="text-left font-bold @if($callback->status == 'Pending') text-blue-500 
                        @elseif($callback->status == 'In Progress') text-yellow-500 
                        @elseif($callback->status == 'Failed') text-red-500
                        @elseif($callback->status == 'Completed') text-green-600 
                        @endif"">{{ $callback->status}}</div>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="mt-5">
            {{ $callbackRequests->links() }}
            </div>
        </div>
    </div>

    @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4 m-auto my-10">
                <span class="font-bold cursor-pointer float-right text-xl leading-none " onclick="this.parentElement.style.display='none';">&times;</span>
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded-md mb-4 sm:max-w-4xl my-10">
                <span class="font-bold cursor-pointer float-right text-xl leading-none" onclick="this.parentElement.style.display='none';">&times;</span>
                {{ session('error') }}
            </div>
            @endif
</body>
</html>
