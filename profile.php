<?php
        include('db.php');

        session_start();
    
        if (isset($_SESSION["user_id"]))
        {
            $sql = "SELECT * FROM users
                    WHERE id = {$_SESSION["user_id"]}";
    
            $result = $mysqli->query($sql);
    
            $user = $result->fetch_assoc();
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css_and_images/profile.css">
    <link rel="stylesheet" href="css_and_images/headerStyles.css">
    <title>Profile</title>
</head>
<body>
    <header>
        <a href="index.php">
        <img class="headerImg" src="css_and_images/images/Logo.png" alt="Company logo">
        </a>
        
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="nav-lines">|</li>
                <li><a href="about.html">About</a></li>
                <li class="nav-lines">|</li>
                <li><a href="shop.php">Shop</a></li>
                <li class="nav-lines">|</li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
            <div class="menu-icon" onclick="toggleMenu()">☰</div>
        </nav>
    </header>

    <div class="profile-container">
        <div class="nav-container">
            <a href="profile.php">Profile</a>
            <a href="#">Orders</a>
            <a href="#">Order History</a>
            <a href="profileEdit.php">Change Account Info</a>
            <a href="cart.php">Go to Cart</a>
            <a href="logout.php">Log out</a>
        </div>

        <div class="main-content">
            <img src="css_and_images/images/ProfilePic.png">
            <div class="profile-name"><?= htmlspecialchars($user["name"]) ?></div>
            <p>Email: <?= htmlspecialchars($user["email"]) ?></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/profilePic.js"></script>
</body>
</html>
