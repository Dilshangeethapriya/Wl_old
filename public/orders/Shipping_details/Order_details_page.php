<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Shipping details</title>
<link rel="stylesheet" type="text/css" href="style_orderDetails.css">
<link rel="stylesheet" href="../home.css">
<script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<header class="bg-[#543310] h-20">
    <nav class="flex justify-between items-center w-[95%] mx-auto">
        <div class="flex items-center gap-[1vw]">
            <img class="w-16" src="Logo.png" alt="Logo">
            <h1 class="text-xl text-white font-sans"><b>WOODLAK</b></h1>
        </div>
        <div class="lg:static absolute bg-[#543310] lg:min-h-fit min-h-[39vh] left-0 top-[9%] lg:w-auto w-full flex items-center px-5 justify-center lg:justify-start text-center lg:text-right xl:contents hidden lg:flex" id="content">
            <ul class="flex lg:flex-row flex-col lg:gap-[4vw] gap-8">
                <li>
                    <a class="text-white hover:text-[#D0B8A8] p-2 underline hover:underline-offset-4" href="../../">Home</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="../../inquiry">Contact Us</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="">About Us</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="../../product/product_catalog.php">Products</a>
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
    <section class="banner">
        <h2 class="text-3xl">SHIPPING DETAILS</h2>
        <div class="card-container">
            <div class="card-img">
              
            </div>

            <div class="card-content">
                <form method="POST" action="process_shipping.php">
                    <div class="form-row">
                        <input type="text" name="name" placeholder="Name" id="name" required>
                        <input type="text" name="phone-Num" placeholder="Phone Number" id="phone-Num" required>
                    </div>
                    <div class="form-row">
                        <input type="text" name="Address-one" placeholder="House No" id="Address-one">
                        <input type="text" name="Address-Two" placeholder="Street Name" id="Address-Two" required>
                    </div>
                    <div class="form-row">
                        <input type="text" name="Address-three" placeholder="City" id="Address-three" required>
                        <input type="text" name="Address-four" placeholder="Postal Code" id="Address-four" required>
                    </div>
                    <div class="form-row">
                        <input type="email" name="Email" placeholder="Email" id="Email" required>
                    </div>
                    <div class="form-row">
                        <input type="submit" value="SUBMIT!" onclick="return validateAll();">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
    function validateAll() {
        var name = document.getElementById("name").value;
        var phoneNumber = document.getElementById("phone-Num").value;
        var AddressOne = document.getElementById("Address-one").value;
        var AddressTwo = document.getElementById("Address-Two").value;
        var AddressThree = document.getElementById("Address-three").value;
        var AddressFour = document.getElementById("Address-four").value;

        if (name === "" || phoneNumber === "") {
            alert("Name and phone number are required fields.");
            return false;
        }
        if (AddressThree === "" || AddressTwo === "" || AddressFour === "") {
            alert("Full Address is required field.");
            return false;
        }

        if (isNaN(phoneNumber)) {
            alert("Phone number must be a numeric value.");
            return false;
        }
        if (AddressOne !== "" && isNaN(AddressOne)) {
            alert("House No must be a numeric value.");
            return false;
        }

        if (isNaN(AddressFour)) {
            alert("Postal code must be a numeric value.");
            return false;
        }

        alert("Shipping details successfully added");
        return true;
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
