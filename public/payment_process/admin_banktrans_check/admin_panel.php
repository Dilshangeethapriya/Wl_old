<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WoodLak";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $transferID = intval($_GET['id']);
    $action = $_GET['action'];

    // Get the OrderID associated with this transfer
    $sql = "SELECT OrderID FROM BankTransfers WHERE transferID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $transferID);
    $stmt->execute();
    $stmt->bind_result($orderID);
    $stmt->fetch();
    $stmt->close();

    if ($action == 'delete') {
        // Update the orderStatus to 'cancelled' in the Orders table
        if ($orderID) {
            $sql = "UPDATE Orders SET orderStatus = 'cancelled' WHERE orderID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $orderID);
            $stmt->execute();
            $stmt->close();
        }

        // Delete the BankTransfer record
        $sql = "DELETE FROM BankTransfers WHERE transferID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $transferID);

        if ($stmt->execute()) {
            echo "Transfer deleted successfully";
        } else {
            echo "Error deleting transfer: " . $conn->error;
        }

        $stmt->close();
    } elseif ($action == 'confirm') {
        // Update the checkStatus to 'Confirmed' in the BankTransfers table
        $sql = "UPDATE BankTransfers SET checkStatus = 'Confirmed' WHERE transferID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $transferID);
        $stmt->execute();
        $stmt->close();

        // Update the orderStatus to 'Confirmed' in the Orders table
        if ($orderID) {
            $sql = "UPDATE Orders SET orderStatus = 'Confirmed' WHERE orderID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $orderID);
            $stmt->execute();
            $stmt->close();
        }

        echo "Transfer confirmed successfully";
    }

    $conn->close();

    // Redirect back to the admin panel
    header("Location: admin_panel.php");
    exit();
}

$sql = "SELECT transferID, depositAmount, accountNumber, accountHolder, transactionID, receiptFile, OrderID, checkStatus FROM BankTransfers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Bank Transfers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #333;
            padding: 20px 0;
        }
        table {
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        td a {
            text-decoration: none;
            color: #0066cc;
            margin-right: 10px;
        }
        td a:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            table, th, td {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

<h1>Bank Transfers Management</h1>

<table>
    <tr>
        <th>Transfer ID</th>
        <th>Deposit Amount</th>
        <th>Account Number</th>
        <th>Account Holder</th>
        <th>Transaction ID</th>
        <th>Receipt File</th>
        <th>Order ID</th>
        <th>Check Status</th>
        <th>Actions</th>
    </tr>

    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row["transferID"]; ?></td>
                <td><?php echo $row["depositAmount"]; ?></td>
                <td><?php echo $row["accountNumber"]; ?></td>
                <td><?php echo $row["accountHolder"]; ?></td>
                <td><?php echo $row["transactionID"]; ?></td>
                <td>
                    <a href="../uploads/<?php echo $row["receiptFile"]; ?>" target="_blank">View File</a>
                </td>
                <td><?php echo $row["OrderID"]; ?></td>
                <td><?php echo $row["checkStatus"]; ?></td>
                <td>
                    <?php if ($row["checkStatus"] !== 'Confirmed'): ?>
                        <a href="admin_panel.php?id=<?php echo $row['transferID']; ?>&action=confirm" onclick="return confirm('Are you sure you want to confirm this transfer?');">Confirm</a>
                        <a href="admin_panel.php?id=<?php echo $row['transferID']; ?>&action=delete" onclick="return confirm('Are you sure you want to delete this transfer?');">Delete</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="9">No records found</td>
        </tr>
    <?php endif; ?>
</table>

</body>
</html>

<?php
$conn->close();
?>
