<?php
// Define variables to store messages
$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection
    include("db.php");

    // Retrieve data from the form
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $cardNumber = $_POST["cardNumber"];
    $expiryDate = $_POST["expiryDate"];
    $cvv = $_POST["cvv"];

    // Validate data (you might want to add more validation)
    if (empty($fullName) || empty($email) || empty($address) || empty($cardNumber) || empty($expiryDate) || empty($cvv)) {
        // Handle validation errors
        $errorMessage = "All fields are required";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO billingInfos (fullName, email, address, cardNumber, expiryDate, cvv)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli->prepare($sql);

        if (!$stmt) {
            $errorMessage = "SQL error: " . $mysqli->error;
        } else {
            $stmt->bind_param("ssssss", $fullName, $email, $address, $cardNumber, $expiryDate, $cvv);

            if ($stmt->execute()) {
                // Data inserted successfully
                $successMessage = "Order placed successfully!";
            } else {
                // Handle errors, e.g., duplicate entry
                if ($mysqli->errno === 1062) {
                    $errorMessage = "Order failed. Duplicate entry detected.";
                } else {
                    $errorMessage = "Order failed. " . $mysqli->error;
                }
            }

            $stmt->close();
        }

        $mysqli->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css_and_images/checkout.css">
    <link rel="stylesheet" href="css_and_images/headerStyles.css">
    <title>Checkout</title>
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

    <section class="mainContainer">
        <h2> Billing Information </h2>

        <?php
        // Display success or error messages
        if (!empty($successMessage)) {
            echo '<p style="color: green;">' . $successMessage . '</p>';
        } elseif (!empty($errorMessage)) {
            echo '<p style="color: red;">' . $errorMessage . '</p>';
        }
        ?>

        <form action="" method="post">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="cardNumber">Card Number:</label>
            <input type="text" id="cardNumber" name="cardNumber" required>

            <label for="expiryDate">Expiry Date:</label>
            <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY" required>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required>

            <button type="submit">Place Order</button>
        </form>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/profilePic.js"></script>
</body>
</html>
