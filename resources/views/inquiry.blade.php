<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - WOODLAK</title>
   
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-100 m-0 p-0">
    <h1 class="text-2xl font-semibold text-center text-gray-800 p-8">Contact Us</h1>

    <hr>

    <div class="flex justify-between p-5 bg-white border border-gray-200 rounded-lg shadow-sm">
        <div class="flex-1 md:flex-none md:w-1/5">
            <div class="flex flex-col">
                <button class="block w-full p-2 mb-2 bg-gray-100 border border-gray-200 rounded-md text-left text-gray-800 hover:bg-gray-200" onclick="showContent('inquiry')">Inquiry</button>
                <button class="block w-full p-2 mb-2 bg-gray-100 border border-gray-200 rounded-md text-left text-gray-800 hover:bg-gray-200" onclick="showContent('callback')">Call back</button>
                <button class="block w-full p-2 mb-2 bg-gray-100 border border-gray-200 rounded-md text-left text-gray-800 hover:bg-gray-200" onclick="showContent('ipCall')">IP call</button>
            </div>
        </div>

        <div class="flex-1 md:flex-none md:w-1/2 p-5">
            <div id="inquiry" class="block">
                <h2 class="text-xl font-semibold mb-4">Send your inquiry</h2>
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

                    <button type="submit" class="mt-5 p-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Send</button>
                </form>
                
                @if($errors->any())
                <div class="alert alert-danger bg-red-500 text-white p-4 rounded-md mt-4">
                    <span class="closebtn absolute top-2 right-2 font-bold text-lg cursor-pointer hover:text-black" onclick="this.parentElement.style.display='none';">&times;</span>
                    <ul>
                        @foreach($errors->all() as $error)
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

            <div id="callback" class="hidden">
                <h2 class="text-xl font-semibold mb-4">Request a Callback</h2>
                <!-- Callback-specific content -->
            </div>

            <div id="ipCall" class="hidden">
                <h2 class="text-xl font-semibold mb-4">Request an IP Call</h2>
                <!-- IP Call-specific content -->
            </div>
        </div>

        <div class="flex-1 md:flex-none md:w-1/4 p-5 bg-gray-800 text-white rounded-lg">
            <h3 class="text-lg font-semibold">Reach Us</h3>
            <p class="mt-2">Email: woodlak@gmail.com</p>
            <p class="mt-2">Phone: +94 77 000 0000</p>
            <p class="mt-2">Address: NO50, Colombo</p>
        </div>
    </div>
  
    <script>
        function showContent(tabName) {
            var i;
            var x = document.getElementsByClassName("tab-content");
            for (i = 0; i < x.length; i++) {
                x[i].classList.add("hidden");
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
</body>
</html>
