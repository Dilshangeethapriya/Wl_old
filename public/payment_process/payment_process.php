<?php
// Payment processing script (payment_process.php)

// Fetch API credentials
$api_username = "xPCUNnJwde";
$api_password = "OkDY4Sj3JT";
$public_key = "-----BEGIN PUBLIC KEY----- ... -----END PUBLIC KEY-----";
$secret_key = "12e7195f-4fc2-463a-bf5f-bc5df35b02c2";

// Get the card details from the POST request
$card_number = $_POST['card_number'];
$expiration_date = $_POST['expiration_date'];
$cvv = $_POST['cvv'];
$billing_address = $_POST['billing_address'];

// Encrypt card details using the public key
// OpenSSL example (ensure the OpenSSL extension is enabled in PHP)
openssl_public_encrypt($card_number, $encrypted_card_number, $public_key);

// Prepare the data for the payment gateway API
$data = array(
    'card_number' => base64_encode($encrypted_card_number),
    'expiration_date' => $expiration_date,
    'cvv' => $cvv,
    'billing_address' => $billing_address,
    'api_username' => $api_username,
    'api_password' => $api_password
);

// Send the data to the payment gateway using cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://payment-gateway-url.com/process-payment");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

// Handle the response
if ($response === FALSE) {
    echo "Payment failed.";
} else {
    echo "Payment successful!";
}
?>
