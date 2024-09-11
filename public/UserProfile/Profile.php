<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="style2.css">
    <style>
        .eye-icon {
            position: absolute;
            margin-left:95px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: black;
        }

        .input-roup {
            position: relative;
        }
    </style>
</head>
<body>
<div class="profile">
    
    <?php
        include 'config.php';
        session_start();

        $user_id = $_SESSION['user_id'];
        $select = mysqli_query($conn, "SELECT * FROM `customer` WHERE customerID = '$user_id'") or die('Query failed');
        if (mysqli_num_rows($select) > 0) {
            $fetch = mysqli_fetch_assoc($select);
        }
    ?>

    <form action="EditProfile.php" method="get">
        <div class="greeting">
            <p>Hello, <?php echo htmlspecialchars($fetch['name']); ?> !!</p>
        </div>
        <?php
            if ($fetch['image'] == '') {
                echo '<img src="images/avatar.png" alt="Profile Picture">';
            } else {
                echo '<img src="uploaded_img/'.$fetch['image'].'" alt="Profile Picture">';
            }
        ?>
        
        <div class="flex">
            <div class="input-roup">
                <span class="span">Username: </span>
                <input type="text" name="profile_name" value="<?php echo htmlspecialchars($fetch['name']); ?>" class="box" readonly>
                <span>Email Address: </span>
                <input type="email" name="profile_email" value="<?php echo htmlspecialchars($fetch['email']); ?>" class="box" readonly>
                <span>Contact number: </span>
                <input type="text" name="profile_contact" value="<?php echo htmlspecialchars($fetch['contact']); ?>" class="box" readonly>
            </div>


            <div class="input-roup">
                <span class="span">Postal Code: </span>
                <input type="text" name="profile_postalCode" value="<?php echo htmlspecialchars($fetch['postalCode']); ?>" class="box" readonly>
                <span class="span">HouseNo: </span>
                <input type="text" name="profile_houseNo" value="<?php echo htmlspecialchars($fetch['houseNo']); ?>" class="box" readonly>
                <span>Street Name: </span>
                <input type="email" name="profile_streetName" value="<?php echo htmlspecialchars($fetch['streetName']); ?>" class="box" readonly>
            </div>

            <div class="input-roup">
                <span>City: </span>
                <input type="text" name="profile_city" value="<?php echo htmlspecialchars($fetch['city']); ?>" class="box" readonly>
                <span>Gender: </span>
                <input type="text" name="profile_gender" value="<?php echo htmlspecialchars($fetch['gender']); ?>" class="box" readonly>
                <span>Password: </span>
                <div class="input-roup">
                    <input type="password" id="profile_password" name="profile_password" value="<?php echo htmlspecialchars($fetch['password']); ?>" class="box" readonly style="width:125px">
                    <i class="fas fa-eye eye-icon" id="togglePassword" onclick="togglePassword()"></i>
                </div>
            </div>
        </div>
        
        <button type="submit" name="editProfile" class="btn">Edit Profile</button>
        <p></p>
        <button type="button" class="btn">Order History</button>
        <p></p>
        <button type="button" id="logoutButton" class="btn"  onclick="location.href='http://localhost:8080/dashboard/woodlak/public/Userprofile/logout.php'">LogOut</button>
    </form>
</div>

<script>
    function togglePassword() {
        const passwordField = document.getElementById('profile_password');
        const eyeIcon = document.getElementById('togglePassword');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }

    document.getElementById('logoutButton').addEventListener('click', function() {
        window.location.href = '/dashboard/woodlak/public/Userprofile/logout.php'; 
    });
</script>
</body>
</html>
