<?php
$conn = mysqli_connect("localhost", "root", "", "woodlak", "3306");

if (!$conn) {
    die("No DB connection");
}

$orderID = isset($_GET['orderID']) ? $_GET['orderID'] : '';

if ($orderID) {
    $sql = "SELECT * FROM orders WHERE orderID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $orderID);
} else {
    $sql = "SELECT * FROM orders";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($orders);

$stmt->close();
$conn->close();
?>
