<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$_SESSION['paymentMethod'] = "Credit Card";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Card Payment</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-neemwood {
            background-color: #a67b5b; /* Replace with your desired neem wood color */
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .bg-neemwood {
            background-color: #a67b5b; /* Background color for the page */
        }

        /* Navbar styles */
        header {
            background-color: #543310;
            height: 80px; /* Adjust as needed */
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 95%;
            max-width: 1200px;
        }

        .navbar-logo img {
            height: 40px;
        }

        .navbar-nav {
            display: flex;
            gap: 1rem;
        }

        .navbar-nav a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
        }

        .navbar-nav a:hover {
            color: #D0B8A8;
        }

        .navbar-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .navbar-buttons button {
            background-color: #74512D;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .navbar-buttons button:hover {
            background-color: #6A3E28;
        }

        .payment-page {
            background-color: #a67b5b;
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 80px); /* Adjust based on navbar height */
            margin-top: 80px; /* Adjust based on navbar height */
            padding: 20px; /* Added padding to ensure content is not stuck to edges */
        }

        .payment-container {
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px 40px;
            max-width: 500px;
            width: 100%;
            position: relative;
            text-align: center; /* Center text inside the container */
        }

        .payment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .bank-logo, .webxpay-logo {
            height: 40px;
        }

        .merchant-name {
            font-size: 20px;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .payment-form label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        .payment-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
        }

        .expiry-cvv {
            display: flex;
            justify-content: space-between;
        }

        .expiry-cvv div {
            width: 32%;
        }

        .total-price {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 16px;
            font-weight: bold;
        }

        .pay-now-btn {
            width: 100%;
            background-color: #ff5722;
            color: #fff;
            padding: 15px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .pay-now-btn:hover {
            background-color: #e64a19;
        }

        .payment-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }

        .payment-footer img {
            height: 15px;
            margin-left: 5px;
        }

        .payment-form input:invalid {
            border-color: red;
        }

        .payment-form input:valid {
            border-color: green;
        }

        .payment-form input {
            font-family: monospace; /* Ensures consistent spacing */
            letter-spacing: 1px; /* Adds a bit of spacing for readability */
        }

        /* Loading effect */
        #loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        #loading-overlay img {
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            100% { transform: rotate(360deg); }
        }

        #loading-overlay p {
            margin-top: 10px;
            font-size: 16px;
            color: #333;
        }

        /* Error message styling */
        #error-message {
            display: none;
            margin-top: 20px;
            background-color: #f44336;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body class="bg-neemwood min-h-screen">

 
    <header class="bg-[#543310] h-20">
    <nav class="flex justify-between items-center w-[95%] mx-auto">
        <div class="flex items-center gap-[1vw]">
            <img class="w-16" src="Logo.png" alt="Logo">
            <h1 class="text-xl text-white font-sans"><b>WOODLAK</b></h1>
        </div>
        <div class="lg:static absolute bg-[#543310] lg:min-h-fit min-h-[39vh] left-0 top-[9%] lg:w-auto w-full flex items-center px-5 justify-center lg:justify-start text-center lg:text-right xl:contents hidden lg:flex" id="content">
            <ul class="flex lg:flex-row flex-col lg:gap-[4vw] gap-8">
                <li>
                    <a class="text-white hover:text-[#D0B8A8] p-2 underline hover:underline-offset-4" href="../">Home</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="../inquiry">Contact Us</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="">About Us</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="../product/product_catalog.php">Products</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="">Orders</a>
                </li>
            </ul>
        </div>
        <?php 
        if(isset($_SESSION['user_name'])) {
            $user_name = $_SESSION['user_name'];
        ?>
        <div class="flex items-center gap-3">
            <span class="mr-4 text-lg"><?php echo $user_name; ?></span>
            <button class="bg-[#74512D] text-white px-5 py-2 rounded-full hover:text-[#D0B8A8]" onclick="location.href='/dashboard/woodlak/public/Userprofile/profile.php'">Profile</button> 
            <button onclick="responsive()"><i class="bi bi-list text-4xl lg:hidden text-white"></i></button>
        </div>
        <?php } else { ?>
        <div class="flex items-center gap-3">
            <button class="bg-[#74512D] text-white px-5 py-2 rounded-full hover:text-[#D0B8A8]" onclick="location.href='/dashboard/woodlak/public/Userprofile/register.php'">Register</button>
            <button class="bg-[#74512D] text-white px-5 py-2 rounded-full hover:text-[#D0B8A8]" onclick="location.href='/dashboard/woodlak/public/Userprofile/login.php'">Login</button>
            <button onclick="responsive()"><i class="bi bi-list text-4xl lg:hidden text-white"></i></button>
        </div>
        <?php } ?>
    </nav>
</header>


    <div class="payment-page">
        <div class="payment-container">
            <div class="payment-header">
                <img src="pictures/Logo.png" alt="DFCC Bank Logo" class="bank-logo">
                <span class="merchant-name">WoodLak</span>
            </div>
            <h2>Please enter your Card Information</h2>
            <form id="payment-form" action="payment_invoice.html" method="POST" class="payment-form" onsubmit="return processPayment()">
                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" name="card_number" placeholder="Enter Card Number" required maxlength="19" oninput="formatCardNumber(this)">

                <label for="card-holder-name">Card Holder Name</label>
                <input type="text" id="card-holder-name" name="card_holder_name" placeholder="Card Holder Name and Surname" required>

                <div class="expiry-cvv">
                    <div>
                        <label for="expiry-month">Expiry Month</label>
                        <input type="text" id="expiry-month" name="expiry_month" placeholder="MM" required minlength="2" maxlength="2" pattern="(0[1-9]|1[0-2])">
                    </div>
                    <div>
                        <label for="expiry-year">Expiry Year</label>
                        <input type="text" id="expiry-year" name="expiry_year" placeholder="YYYY" required minlength="4" maxlength="4" pattern="20[2-9][0-9]">
                    </div>
                    <div>
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" placeholder="***" required minlength="3" maxlength="4" pattern="\d{3,4}">
                    </div>
                </div>

                <div class="total-price">
                    <span>Total Price</span>
                    <span id="total-price">Rs. <?php echo $_SESSION['totalPrice']; ?></span>
                </div>

                <button type="submit" class="pay-now-btn">Pay Now</button>
            </form>
            <div class="payment-footer">
                <span>Powered by woodlak.lk</span>
            </div>
            <div id="loading-overlay">
                <img src="pictures/loading.webp" alt="Loading...">
                <p>Processing Payment...</p>
            </div>
            <div id="error-message">
                Payment Declined! Please check your card details and try again.
            </div>
        </div>
    </div>

    <script>
        function formatCardNumber(input) {
            const value = input.value.replace(/\D/g, ''); 
            const formattedValue = value.replace(/(\d{4})(?=\d)/g, '$1 '); 
            input.value = formattedValue;
        }

        function processPayment() {
            const cardNumber = document.getElementById('card-number').value.replace(/\s+/g, ''); 

            
            const validCardNumbers = ['4242424242424242', '1212121212121212'];

            
            document.getElementById('loading-overlay').style.display = 'flex';

            setTimeout(() => {
                if (validCardNumbers.includes(cardNumber)) {
                    window.location.href = "payment_invoice.php"; 
                } else {
                    document.getElementById('loading-overlay').style.display = 'none';
                    document.getElementById('error-message').style.display = 'block'; 
                }
            }, 2000); 

            return false; 
        }

        function responsive() {
            var x = document.getElementById("content");
            if (x.classList.contains("hidden")) {
                x.classList.remove("hidden");
            } else {
                x.classList.add("hidden");
            }
        }
    </script>

</body>
</html>
