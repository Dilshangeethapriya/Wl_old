<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productID = $_POST['productID'];
    $requetType = $_POST['requetType'];  

    // Remove the item  
    if($requetType == "remove") {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['productID'] == $productID) {
                unset($_SESSION['cart'][$key]);              
            }
        }
    }

    // Update the Quantity 
    if($requetType == "quantity") {

        $quantityInput = 0;
        if (isset($_POST['decrease'])) {
            $quantityInput = -1;
        }
        elseif (isset($_POST['increase'])) {
            $quantityInput = 1;
        }

        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['productID'] == $productID) {
                if($_SESSION['cart'][$key]['quantity'] == 1 && isset($_POST['decrease'])){
                    
                }
                else{
                    $_SESSION['cart'][$key]['quantity'] += $quantityInput; 
                }                     
            }
        }
    }  
    header('Location: shopping_cart.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="cart.css">
    <style>
        body{
            background-color:#c19a6b;
        }
        .table-header {
            background-color: #5a2b09;
            color: white;
        }
        .table-row {
            border-bottom: 1px solid #dee2e6;
        }
        .table-row:hover {
            background-color: #f1f1f1;
        }
        .remove-btn {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
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
                    <a class="text-white hover:text-[#D0B8A8] " href="../">Home</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="../inquiry">Contact Us</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="../aboutUs/About_Us.php">About Us</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="product_catalog.php">Products</a>
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
    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-extrabold mb-6 text-[#5a2b09]">Shopping Cart</h1>
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
           
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr class="table-header">
                            <th class="py-3 px-4 text-left">Product Name</th>
                            <th class="py-3 px-4 text-left">Price</th>
                            <th class="py-3 px-4 text-left">Quantity</th>
                            <th class="py-3 px-4 text-left">Total</th>
                            <th class="py-3 px-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $key => $item):
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        ?>
                            <tr class="table-row">
                                <td class="py-4 px-4"><?php echo htmlspecialchars($item['productName']); ?></td>
                                <td class="py-4 px-4">Rs.<?php echo htmlspecialchars($item['price']); ?></td>
                                <td class="py-4 px-4">
                                <form action="shopping_cart.php" method="POST" class="flex items-center">
                                    <input type="hidden" name="productID" value="<?php echo htmlspecialchars($item['productID']); ?>">
                                    <input type="hidden" name="requetType" value="quantity">
                                    <button type="submit" class="px-3 py-1 text-white bg-[#78350f] rounded-full mr-2" name="decrease" class="remove-btn py-1 px-3 rounded">-</button>
                                    <input type="number" name="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>" min="1" class="border rounded px-2 py-1 w-10 text-center" readonly>
                                    <button type="submit" class="px-3 py-1 text-white bg-[#78350f] rounded-full ml-2" name="increase" class="remove-btn py-1 px-3 rounded">+</button>
                                </form>
                                </td>
                                <td class="py-4 px-4">Rs.<?php echo htmlspecialchars($subtotal); ?></td>
                                <td class="py-4 px-4 text-center">
                                    <form action="shopping_cart.php" method="POST">
                                        <input type="hidden" name="productID" value="<?php echo htmlspecialchars($item['productID']); ?>">
                                        <input type="hidden" name="requetType" value="remove">
                                        <button type="submit" class="remove-btn py-1 px-3 rounded">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="font-bold">
                            <td colspan="3" class="text-right py-4 px-4">Total</td>
                            <td class="py-4 px-4">Rs.<?php echo htmlspecialchars($total); ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <form action="../orders/Shipping_details/Order_details_page.php" method="post">
                    <!-- Hidden fields to pass cart details -->
                    <input type="hidden" name="cart" value='<?php echo htmlspecialchars(json_encode($_SESSION['cart'])); ?>'>
                    <input type="hidden" name="total" value="<?php echo htmlspecialchars($total); ?>">
                    <div class="mt-6 text-center">
                        <a class=" py-2.5 px-6 rounded-full text-lg bg-[#78350f] hover:bg-[#5a2b09] text-white" href="product_catalog.php">Add More</a>
                        <button type="submit" class=" py-2 px-6 rounded-full text-lg bg-[#78350f] hover:bg-[#5a2b09] text-white">Checkout</button>
                    </div>
                </form>
        <?php else: ?>
            <p class="text-lg font-semibold text-gray-600 mb-5">Your cart is empty.</p>
            <a class=" py-2.5 px-6 rounded-full text-lg bg-[#78350f] hover:bg-[#5a2b09] text-white" href="product_catalog.php">Back</a>
        <?php endif; ?>
    </div>
    <script>
    function responsive() {
        var x = document.getElementById("content");
        x.classList.toggle("hidden");
    } 
        </script>
    </body>
</html>

</body>
</html>
