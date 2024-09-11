<?php
session_start();

// Set payment method to "Bank Transfer"
$_SESSION['paymentMethod'] = "Bank Transfer";

// Ensure the session has the totalPrice set
if (!isset($_SESSION['totalPrice'])) {
    echo "Error: Total price is not set in the session.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Retrieve form data
        $depositAmount = $_POST['depositAmount'];
        $accountNumber = $_POST['accountNumber'];
        $accountHolder = $_POST['accountHolder'];
        $transactionID = $_POST['transactionID'];

        // Handle file upload
        $receiptFile = null;
        if (isset($_FILES['receiptUpload']) && $_FILES['receiptUpload']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['receiptUpload']['tmp_name'];
            $fileName = $_FILES['receiptUpload']['name'];
            $fileNameCmps = explode('.', $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Define allowed file extensions
            $allowedExts = array('jpg', 'jpeg', 'png', 'pdf');
            if (in_array($fileExtension, $allowedExts)) {
                $uploadFileDir = './uploads/';
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $newFileName;
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $receiptFile = $newFileName;
                } else {
                    throw new Exception('Failed to move uploaded file.');
                }
            } else {
                throw new Exception('Unsupported file type.');
            }
        }

        // Store form data in session variables
        $_SESSION['depositAmount'] = $depositAmount;
        $_SESSION['accountNumber'] = $accountNumber;
        $_SESSION['accountHolder'] = $accountHolder;
        $_SESSION['transactionID'] = $transactionID;
        $_SESSION['receiptFile'] = $receiptFile;

        // Redirect to payment_invoice.php
        header("Location: payment_invoice.php");
        exit;
    } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Transfer Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .bg-neemwood {
            background-color: #a67b5b; /* Neem wood color */
        }
    </style>
</head>

<body class="bg-neemwood p-2">
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
    <div class="max-w-md mx-auto bg-white p-2 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Bank Transfer Instructions</h2>
        
        <p class="text-gray-700 mb-2">Account Number: <span class="font-semibold">8018887521</span></p>
        <p class="text-gray-700 mb-2">Name of the Account Holder: <span class="font-semibold">K.D.M.Perera</span></p>
        <p class="text-gray-700 mb-4">Branch: <span class="font-semibold">Commercial Bank - KALUTARA</span></p>

        <p class="text-red-600 font-bold mb-4">Please note! Only do the payment for your purchase.</p>

        <form action="" method="post" enctype="multipart/form-data">
            <!-- Deposit amount is set automatically from the session variable -->
            <input type="number" id="deposit-amount" name="depositAmount" 
                   value="<?php echo $_SESSION['totalPrice']; ?>" 
                   class="w-full mb-4 p-2 border border-gray-300 rounded" readonly required>

            <label for="account-number" class="block text-gray-700 mb-2">Your Account No:</label>
            <input type="text" id="account-number" name="accountNumber" placeholder="Your Account No"
                class="w-full mb-4 p-2 border border-gray-300 rounded" required>

            <label for="account-holder" class="block text-gray-700 mb-2">Name of the Account Holder:</label>
            <input type="text" id="account-holder" name="accountHolder" placeholder="Name of the Account Holder"
                class="w-full mb-4 p-2 border border-gray-300 rounded" required>

            <label for="transaction-id" class="block text-gray-700 mb-2">Transaction ID (UTR, Reference No):</label>
            <input type="text" id="transaction-id" name="transactionID" placeholder="Transaction ID"
                class="w-full mb-4 p-2 border border-gray-300 rounded" required>

            <label for="receipt-upload" class="block text-gray-700 mb-2">Upload Transaction Receipt (jpg, jpeg, png, pdf):</label>
            <input type="file" id="receipt-upload" name="receiptUpload" accept=".jpg,.jpeg,.png,.pdf"
                class="w-full mb-4 p-2 border border-gray-300 rounded" required>

            <p class="text-red-600 font-bold mb-4">* Click confirm after the submission</p>

            <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">CONFIRM</button>
        </form>
    </div>
    <script>
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
