<?php
include 'dbcon.php';
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Product Catalog</title>
        <meta charset="utf-8">
		<meta name="veiwport" content="width=device-width,intial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
                    <a class="text-white hover:text-[#D0B8A8] p-2 underline hover:underline-offset-4" href="../">Home</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="../inquiry">Contact Us</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="/path/to/about_us.php">About Us</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="">Products</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="/path/to/orders.php">Orders</a>
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

<script>
    function responsive() {
        var x = document.getElementById("content");
        x.classList.toggle("hidden");
    }
</script>

        <div class="catalog grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 p-8">
            <?php
            $sql = "SELECT productID, productName, price, image FROM product";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="product bg-white p-6 rounded-lg shadow-lg">';
                    echo '<a href="view_product.php?PRODUCTC=' . $row['productID'] . '"><img src="' . $row['image'] . '" alt="' . $row['productName'] . '" class="w-full h-48 object-cover mb-4 rounded-lg"></a>';
                    echo '<h2 class="text-2xl font-bold mb-2 text-center">' . $row['productName'] . '</h2>';
                    echo '<p class="price text-xl mb-4 text-center">Rs.' . $row['price'] . '</p>';
                    echo '<form method="POST" action="add_to_cart.php">';
                    echo '<input type="hidden" name="productID" value="' . $row['productID'] . '">';
                    echo '<input type="hidden" name="productName" value="' . $row['productName'] . '">';
                    echo '<input type="hidden" name="price" value="' . $row['price'] . '">';
                    echo '<button type="submit" class="bg-[#78350f] hover:bg-[#5a2b09] text-white rounded-full px-10 py-3 text-l border-2 border-[#78350f] mx-auto mb-4 flex items-center">';
                    echo '<b>Add to Cart</b>';
                    echo '</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>No products found.</p>';
            }

            mysqli_close($conn);
            ?>
        </div>
        <a href="shopping_cart.php" class="shoppingCart bg-[#78350f] hover:bg-white text-white hover:text-[#78350f] fixed bottom-3 right-5  p-3 rounded-full shadow-lg">
        <i class="bi bi-cart4 text-2xl"></i>
        </a>
        <script>
            function toggle() {
                var x = document.getElementById("content");
                if (x.style.display === "block") {
                    x.style.display = "none";
                } else {
                    x.style.display = "block";
                }
            }
        </script>
    </body>
</html>