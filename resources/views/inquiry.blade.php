<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - WOODLAK</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        
        .bg-translucent {
            background-color: rgba(255, 255, 255, 0.7); 
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased"
      style="background-image: url('{{ asset('storage/bg1.jpg') }}'); background-size: cover;">
    <x-navbar/>



    <div class="bg bg-transparent text-white p-10 mb-20 ">
    <h2 class="text-center text-2xl font-semibold mb-10">GET IN TOUCH</h2>
    <div class="flex justify-around text-center ">

        <div class="flex flex-col items-center">
            <div class=" text-teal-800 p-4 rounded-full mb-5">
            <img class="w-14" src="{{ asset('storage/circle.png') }}" alt="phone">
            </div>
            <h3 class="text-lg font-semibold mb-2">ADDRESS</h3>
            <p>Piliyandala, Sri Lanka, 10300</p>

        </div>

       
        <div class="flex flex-col items-center">
            <div class=" text-teal-800 p-4 mb-5">
            <img class="w-14" src="{{ asset('storage/phone-call.png') }}" alt="phone">
            </div>
            <h3 class="text-lg font-semibold mb-2">PHONE</h3>
            <p>077 379 3553</p>
        </div>

        <div class="flex flex-col items-center">
            <div class=" text-teal-800 p-4  mb-5">
            <img class="w-14" src="{{ asset('storage/email.png') }}" alt="phone">
            </div>
            <h3 class="text-lg font-semibold mb-2">EMAIL</h3>
            <p>tsamoj@gmail.com</p>
        </div>
    </div>
</div>
 <h2> </h2>
 <div class="flex justify-between p-5 bg-translucent border border-gray-200 rounded-lg shadow-sm max-w-6xl mx-auto">
    <div class="flex-1 md:flex-none md:w-1/5">
        <div class="flex flex-col">
            <button class="block w-full p-2 mb-2 bg-gray-100 border border-gray-200 rounded-md text-left text-gray-800 hover:bg-gray-200" onclick="showContent('inquiry')">Inquiry</button>
            <button class="block w-full p-2 mb-2 bg-gray-100 border border-gray-200 rounded-md text-left text-gray-800 hover:bg-gray-200" onclick="showContent('callback')">Call back</button>
        </div>
    </div>

    <div class="flex-1 md:flex-none md:w-1/2 p-5 max-w-lg mx-auto">
        <div id="inquiry" class="tab-content hidden">
            <h2 class="text-2xl font-semibold mb-4">Send Your Inquiry</h2>
            <form method="post" action="{{ route('addInquiry') }}" class="flex flex-col">
                @csrf
                <label for="name" class="mt-2 font-semibold text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="p-2 mt-1 border border-gray-200 rounded-md">

                <label for="phone" class="mt-2 font-semibold text-gray-700">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="p-2 mt-1 border border-gray-200 rounded-md">

                <label for="email" class="mt-2 font-semibold text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="p-2 mt-1 border border-gray-200 rounded-md">

                <label for="subject" class="mt-2 font-semibold text-gray-700">Subject</label>
                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="p-2 mt-1 border border-gray-200 rounded-md">

                <label for="message" class="mt-2 font-semibold text-gray-700">Message</label>
                <textarea id="message" name="message" class="p-2 mt-1 border border-gray-200 rounded-md">{{ old('message') }}</textarea>

                <button type="submit" class="mt-5 p-2 bg-green-600 text-white rounded-md hover:bg-blue-700">Send</button>
            </form>
        </div>

        <div id="callback" class="tab-content hidden">
            <h2 class="text-2xl font-semibold mb-4">Request a Callback</h2>
            <form action="{{ route('addCallBackRequest') }}" method="POST" class="flex flex-col rounded-lg p-5 max-w-lg mx-auto">
                @csrf
                <label for="name" class="mt-2 font-semibold text-gray-700">Name</label>
                <input type="text" id="name" name="name" class="p-2 mt-1 border border-gray-200 rounded-md" required>

                <label for="phone" class="mt-2 font-semibold text-gray-700">Phone</label>
                <input type="text" id="phone" name="phone" class="p-2 mt-1 border border-gray-200 rounded-md" required>

                <legend class="mt-2 font-semibold text-gray-700">Available Time</legend>
                <div class="flex items-center mt-2">
                    <div class="flex-1 mr-2">
                        <label for="time_from" class="font-semibold text-gray-700">From</label>
                        <input type="time" id="time_from" name="time_from" class="p-2 mt-1 border border-gray-200 rounded-md" required>
                    </div>
                    <div class="flex-1">
                        <label for="time_to" class="font-semibold text-gray-700">To</label>
                        <input type="time" id="time_to" name="time_to" class="p-2 mt-1 border border-gray-200 rounded-md" required>
                    </div>
                </div>

                <button type="submit" class="mt-5 p-2 bg-green-600 text-white rounded-md hover:bg-blue-700">Submit Callback Request</button>
            </form>
           
        </div>
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

                @if(session('success'))
                <div class="alert alert-success bg-green-500 text-white p-4 rounded-md mt-4">
                    <span class="closebtn absolute top-2 right-2 font-bold text-lg cursor-pointer hover:text-black" onclick="this.parentElement.style.display='none';">&times;</span>
                    {{ session('success') }}
                </div>
                @endif
    </div>
</div>


  
    <script>
        function showContent(tabName) {
            var tabs = document.getElementsByClassName("tab-content");
            for (var i = 0; i < tabs.length; i++) {
                tabs[i].classList.add("hidden");
            }
            document.getElementById(tabName).classList.remove("hidden");
        }

        document.getElementById("inquiry").classList.remove("hidden");
    </script>
    <script type="text/javascript">
        window.$crisp = [];
        window.CRISP_WEBSITE_ID = "a8e437fa-4387-4062-95ab-74a78f886f17";
        (function() {
            var d = document;
            var s = d.createElement("script");
            s.src = "https://client.crisp.chat/l.js";
            s.async = 1;
            d.getElementsByTagName("head")[0].appendChild(s);
        })();
    </script>
    <x-footer />

</body>
</html>
