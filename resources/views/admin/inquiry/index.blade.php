<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Inquiries</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100 p-5">
  <h1 class="font-bold cursor-pointer  text-3xl text-center">Inquiry Managment</h1>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-4xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h1 class="text-center text-2xl font-semibold mb-5 text-gray-700">Customer Inquiries</h1>
            
            @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                <span class="font-bold cursor-pointer float-right text-xl leading-none" onclick="this.parentElement.style.display='none';">&times;</span>
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                <span class="font-bold cursor-pointer float-right text-xl leading-none" onclick="this.parentElement.style.display='none';">&times;</span>
                {{ session('error') }}
            </div>
            @endif

            <div class="flex flex-col space-y-3">
                <div class="flex justify-between bg-gray-200 p-3 rounded-t-lg text-gray-600">
                    <div><strong>Name</strong></div>
                    <div><strong>Subject</strong></div>
                    <div><strong>Date and Time</strong></div>
                    <div><strong>Status</strong></div>
                </div>
                @foreach($inquiries as $inquiry)
                <a href="{{ route('admin.inquiry.viewInquiry', $inquiry->ticketID) }}" class="hover:bg-gray-50">
                    <div class="flex justify-between p-3 border-b border-gray-300 text-gray-700">
                        <div>{{ $inquiry->name }}</div>
                        <div>{{ $inquiry->subject }}</div>
                        <div>{{ $inquiry->created_at }}</div>
                        <div class="font-semibold
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
    </div>
</body>
</html>
