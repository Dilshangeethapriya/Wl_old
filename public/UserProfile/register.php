<?php

include 'config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    // $image = $_FILES['image']['name'];
    // $image_size = $_FILES['image']['size'];
    // $image_tmp_name = $_FILES['image']['tmp_name'];
    // $image_folder = 'uploaded_img/' . $image;

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message[] = 'Invalid email format!';
    } elseif (strlen($password) < 10) {
        $message[] = 'Password must be at least 10 characters long!';
    } else {
        $select = mysqli_query($conn, "SELECT * FROM `customer` WHERE email = '$email'") or die('query failed');

        if (mysqli_num_rows($select) > 0) {
            $message[] = 'User with this email already exists!';
        } else {
            if ($password != $confirm_password) {
                $message[] = 'Confirm password does not match!';
            } else {
                $insert = mysqli_query($conn, "INSERT INTO `customer`(name, email, password) VALUES('$name', '$email', '$password')") or die('query failed');

                if ($insert) {
                 
                    $message[] = 'Registered Successfully!';
                    header('location:login.php');
                    exit(); 
                } else {
                    $message[] = 'Registration Failed!';
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="register-container">
        <form action="register.php" method="POST" class="register-form" enctype="multipart/form-data">
            <h2>REGISTER</h2>
            <?php
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '<div class="message">' . $message . '</div>';
                }
            }
            ?>
            <div class="input-group">
                <input type="text" name="username" placeholder="Enter Username" required>
            </div>
            <div class="input-group">
                <input type="email" name="email" placeholder="Enter Email" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Enter Password" required>
            </div>
            <div class="input-group">
                <input type="password" name="confirm_password" placeholder="Re-Enter Password" required>
            </div>
            
            <button type="submit" name="submit" class="btn">Register Now</button>
            <p>Already have an account? <a href="login.php">Login Now</a></p>
        </form>
    </div>
</body>
</html>
