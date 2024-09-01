<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - WOODLAK</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }

        .heading {
            padding: 30px;
            text-align: center;
            font-size: 2rem;
            font-weight: 600;
            color: #1f2937; /* Tailwind's gray-800 */
        }

        .contact-container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #e5e7eb; /* Tailwind's gray-200 */
            border-radius: 0.5rem; /* Tailwind's rounded-lg */
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); /* Tailwind's shadow-sm */
        }

        .tabs {
            flex-basis: 20%;
        }

        .tabs button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f3f4f6; /* Tailwind's gray-100 */
            border: 1px solid #e5e7eb; /* Tailwind's gray-200 */
            border-radius: 0.375rem; /* Tailwind's rounded-md */
            cursor: pointer;
            font-size: 1rem;
            text-align: left;
            color: #1f2937; /* Tailwind's gray-800 */
            transition: background-color 0.2s;
        }

        .tabs button:hover {
            background-color: #e5e7eb; /* Tailwind's gray-200 */
        }

        .content {
            flex-basis: 50%;
            padding: 20px;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .contact-info {
            flex-basis: 25%;
            padding: 20px;
            background-color: #1f2937; /* Tailwind's gray-800 */
            color: #ffffff;
            border-radius: 0.5rem; /* Tailwind's rounded-lg */
        }

        .contact-info p {
            margin: 10px 0;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            font-weight: 600;
            color: #374151; /* Tailwind's gray-700 */
        }

        input, textarea {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #e5e7eb; /* Tailwind's gray-200 */
            border-radius: 0.375rem; /* Tailwind's rounded-md */
        }

        button[type="submit"] {
            margin-top: 20px;
            padding: 10px;
            background-color: #2563eb; /* Tailwind's blue-600 */
            color: #ffffff;
            border: none;
            border-radius: 0.375rem; /* Tailwind's rounded-md */
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button[type="submit"]:hover {
            background-color: #1d4ed8; /* Tailwind's blue-700 */
        }

        .alert {
            padding: 20px;
            color: #ffffff;
            margin-bottom: 15px;
            margin-top: 15px;
            border-radius: 0.375rem; /* Tailwind's rounded-md */
            position: relative;
        }

        .closebtn {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #ffffff;
            font-weight: bold;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .closebtn:hover {
            color: #000000;
        }

        .alert-success {
            background-color: #10b981; /* Tailwind's green-500 */
        }

        .alert-danger {
            background-color: #ef4444; /* Tailwind's red-500 */
        }
    </style>
</head>
<body>
    <h1 class="heading">Contact Us</h1>
    <div class="contact-container">
        <div class="tabs">
            <button onclick="showContent('inquiry')">Inquiry</button>
            <button onclick="showContent('callback')">Call back</button>
            <button onclick="showContent('ipCall')">IP call</button>
        </div>
        <div class="content">
            <div id="inquiry" class="tab-content active">
                <h2>Send your inquiry</h2>
                <form method="post" action="{{ route('addInquiry') }}">
                    @csrf
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}">
                    <label for="message">Message</label>
                    <textarea id="message" name="message">{{ old('message') }}</textarea>
                    <button type="submit">Send</button>
                </form>
                <!-- display validation errors -->
                @if($errors->any())
                <div class="alert alert-danger">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- display submit success message -->
                @if(session('success'))
                <div class="alert alert-success">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    {{ session('success') }}
                </div>
                @endif
            </div>
            <div id="callback" class="tab-content">
                <h2>Request a Callback</h2>
                <!-- Callback-specific content -->
            </div>
            <div id="ipCall" class="tab-content">
                <h2>Request an IP Call</h2>
                <!-- IP Call-specific content -->
            </div>
        </div>
        <div class="contact-info">
            <h3>Reach Us</h3>
            <p>Email: woodlak@gmail.com</p>
            <p>Phone: +94 77 000 0000</p>
            <p>Address: NO50, Colombo</p>
        </div>
    </div>
  
    <script>
        function showContent(tabName) {
            var i;
            var x = document.getElementsByClassName("tab-content");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(tabName).style.display = "block";
        }

        // By default, show the first tab
        document.getElementById("inquiry").style.display = "block";
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
