<!-- profile-edit.php -->
<?php
    session_start();
    include('db.php');

    // Check if the user is logged in
    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }

    $user_id = $_SESSION["user_id"];

    // Fetch user information from the database
    $sql = "SELECT * FROM users WHERE ID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Handle form submission for updating user information
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Handle form submission and update the user information in the database
        $newName = $_POST["name"];
        $newEmail = $_POST["email"];
        $newPassword = $_POST["password"];

        // Using password_hash for security
        $password_hash = password_hash($newPassword, PASSWORD_DEFAULT);

        // Add validation and error handling as needed

        $updateSql = "UPDATE users SET name = ?, email = ?, password_hash = ? WHERE ID = ?";
        $updateStmt = $mysqli->prepare($updateSql);
        $updateStmt->bind_param("sssi", $newName, $newEmail, $password_hash, $user_id);
        $updateStmt->execute();

        // Redirect to the profile page after the update
        header("Location: profile.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css_and_images/headerStyles.css">
    <link rel="stylesheet" href="css_and_images/profile.css">
    <title>Profile Editing</title>
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
            <div class="formContainer">
                <h1> Edit Profile </h1>
                <form action="profileEdit.php" method="post" novalidate>
                    <div>
                        <label for="name"> Name: </label>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($user["name"]) ?>">
                    </div>
        
                    <div>
                        <label for="email"> Email: </label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user["email"]) ?>">
                    </div>

                    <div>
                        <label for="password"> New Password: </label>
                        <input type="password" id="password" name="password">
                    </div>
        
                    <button> Save Changes </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/profilePic.js"></script>
</body>
</html>
