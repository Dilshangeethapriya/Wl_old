<?php
//session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Woodlak Neem Combs</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="resources/css/index.css">
        
    </head>

    <body>
    <header class="bg-[#543310] h-20  top-0 w-full z-40">
    <nav class="flex justify-between items-center w-[95%] mx-auto">
        <div class="flex items-center gap-[1vw]">
            <img class="w-16" src="resources/images/inquiry/Logo.png" alt="Logo">
            <h1 class="text-xl text-white font-sans"><b>WOODLAK</b></h1>
        </div>
        <div class="lg:static absolute bg-[#543310] lg:min-h-fit min-h-[39vh] left-0 top-[9%] lg:w-auto w-full flex items-center px-5 justify-center lg:justify-start text-center lg:text-right xl:contents hidden lg:flex" id="content">
            <ul class="flex lg:flex-row flex-col lg:gap-[4vw] gap-8">
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="../">Home</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="../inquiry">Contact Us</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="../aboutUs/About_Us.php">About Us</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="">Products</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="#">Orders</a>
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
            <button onclick="responsive()"><i class="bi bi-list text-4xl lg:hidden text-white z-50"></i></button>
        </div>
        <?php } else { ?>
        <div class="flex items-center gap-3">
            <button class="bg-[#74512D] text-white px-5 py-2 rounded-full hover:text-[#D0B8A8]" onclick="location.href='/dashboard/woodlak/public/Userprofile/register.php'">Register</button>
            <button class="bg-[#74512D] text-white px-5 py-2 rounded-full hover:text-[#D0B8A8]" onclick="location.href='/dashboard/woodlak/public/Userprofile/login.php'">Login</button>
            <button onclick="responsive()"><i class="bi bi-list text-4xl lg:hidden text-white z-50"></i></button>
        </div>
        <?php } ?>
    </nav>
</header>


<section class="feature-section text-center mt-40 mx-4">
    <h2 class="text-4xl font-semibold header-title mb-5">Why Choose Our Neem Combs?</h2>
    <div class="flex flex-col md:flex-row justify-center gap-8">
        
        <div class="md:w-[30%] w-full">
            <i class="bi bi-flower3 text-5xl mb-3"></i>
            <h3 class="text-2xl font-semibold subheading">Natural Benefits</h3>
            <p>Neem has natural antibacterial properties that promote a healthy scalp and reduce dandruff.</p>
        </div>
        
        <div class="md:w-[30%] w-full">
            <i class="bi bi-gem text-5xl mb-3"></i>
            <h3 class="text-2xl font-semibold subheading">Durability</h3>
            <p>Our combs are strong and long-lasting, crafted from premium neem wood for everyday use.</p>
        </div>
        
        <div class="md:w-[30%] w-full">
            <i class="bi bi-recycle text-5xl mb-3"></i>
            <h3 class="text-2xl font-semibold subheading">Eco-Friendly</h3>
            <p>Our combs are 100% biodegradable, making them a sustainable choice for your daily hair care routine.</p>
        </div>
        
    </div>
</section>

        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-10 px-4 w-5/6 mx-auto">

<!-- First card -->
<a href="product/product_catalog.php" class="sm:h-72 md:h-80 lg:h-96 sm:my-20 md:my-10"> 
    <div class="comb-card bg-[#543310] text-center rounded-lg shadow-lg p-3 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 h-96">
        <img src="resources/images/Curly_Hair.jpg" alt="Curly Hair Comb" class="w-full h-56 rounded-t-lg object-cover">
        <h3 class="mt-3 text-2xl header-title">Curly Hair Neem Comb</h3>
        <p class="mt-3 text-[#E2D1C3]">Perfect for defining curls and reducing frizz naturally.</p> 
    </div>
</a>

<!-- Second card -->
<a href="product/product_catalog.php" class="sm:h-72 md:h-80 lg:h-96 sm:my-20 md:my-10">
    <div class="comb-card bg-[#543310] text-center rounded-lg shadow-lg p-3 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 h-96">
        <img src="resources/images/Straight_Hair.png" alt="Straight Hair Comb" class="w-full h-56 rounded-t-lg object-cover">
        <h3 class="mt-3 text-2xl header-title">Straight Hair Neem Comb</h3>
        <p class="mt-3 text-[#E2D1C3]">For smooth and tangle-free hair, with gentle detangling action.</p> 
    </div>
</a>

<!-- Third card, centered in 2-column layout -->
<a href="product/product_catalog.php" class="sm:h-72 md:h-80 lg:h-96 sm:my-20 md:my-10 md:col-span-2 lg:col-span-1 md:flex md:mx-auto  md:w-2/4 lg:w-full">
    <div class="comb-card bg-[#543310] text-center rounded-lg shadow-lg p-3 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 h-96">
        <img src="resources/images/Thick_Hair.jpg" alt="Thick Hair Comb" class="w-full h-56 rounded-t-lg object-cover">
        <h3 class="mt-3 text-2xl header-title">Thick Hair Neem Comb</h3>
        <p class="mt-3 text-[#E2D1C3]">Ideal for thick hair, providing a firm yet smooth combing experience.</p> 
    </div>
</a>

</section>
<footer class="bg-[#543310] text-white mt-10">
    <div class="container mx-auto py-6 px-4 flex flex-col md:flex-row justify-between items-center">
        
        <div class="flex justify-center md:justify-start mb-4 md:mb-0">
            <a href="https://web.facebook.com/woodlak123" class="text-white mx-2 hover:text-gray-400">
                <i class="bi bi-facebook text-xl"></i>
            </a>
            <a href="#" class="text-white mx-2 hover:text-gray-400">
                <i class="bi bi-instagram text-xl"></i>
            </a>

        </div>

        
         <div class="text-center md:text-left">
            <p>&copy; 2024 WOODLAK. All rights reserved. 
                <a href="../orders/terms_and_conditions/termsAndCondition.html" class="text-white hover:text-gray-400 ml-2">Terms and Conditions</a>
            </p>
        </div>

       
        <div class="mt-4 md:mt-0">
            <a href="#" class="text-white hover:text-gray-400">
                <i class="bi bi-arrow-up-circle-fill text-2xl"></i>
            </a>
        </div>
    </div>
</footer>



        <script src="resources/JS/navbar.js"></script>
    </body>
</html>
