<?php
    session_start();
    include('db.php');
    $status="";
    $array_keys = array();
    if (isset($_POST['code']) && $_POST['code']!="")
    {
        $code = $_POST['code'];
        $result = mysqli_query($mysqli,"SELECT * FROM `products` WHERE `code`='$code'");
        $row = mysqli_fetch_assoc($result);
        $name = $row['Name'];
        $code = $row['Code'];
        $price = $row['Price'];
        $image = $row['Image'];

        $cartArray = array(
            $code=>array(
            'name'=>$name,
            'code'=>$code,
            'price'=>$price,
            'quantity'=>1,
            'image'=>$image)
        );

        if(empty($_SESSION["shopping_cart"])) 
        {
            $_SESSION["shopping_cart"] = $cartArray;
            $status = "<div class='box'>Product is added to your cart!</div>";
        }
        else
        {
            $array_keys = array_keys($_SESSION["shopping_cart"]);
            if(in_array($code,$array_keys)) 
            {
                $status = "<div class='modal' style='color:red;'>Product is already added to your cart!</div>";
            } 
            else 
            {
                $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
                $status = "<div class='modal'>Product is added to your cart!</div>";
            }

        }
    }

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css_and_images/shopAndCartStyles.css">
    <link rel="stylesheet" href="css_and_images/headerStyles.css">
    <link rel="stylesheet" href="css_and_images/footerStyles.css">
    <title>Shop</title>
</head>
<body>
    <header>
        <?php if(isset($user)): ?>

            <a href="index.php">
            <img class="headerImg" src="css_and_images/images/Logo.png" alt="Company logo">
            </a>
            
            <nav>
                <ul class="showUl">
                    <li><a href="index.php">Home</a></li>
                    <li class="nav-lines">|</li>
                    <li><a href="about.html">About</a></li>
                    <li class="nav-lines">|</li>
                    <li><a href="shop.php">Shop</a></li>
                    <li class="nav-lines">|</li>
                    <li><a href="contact.html">Contact</a></li>
                    <li class="profile">
                        <img src="css_and_images/images/ProfilePic.png" id="profilePic" onclick="toggleDropdown()">
                        <div class="dropdown-content" id="dropdownContent">
                            <p><?= htmlspecialchars($user["name"]) ?></p>
                            <a href="profile.php">Profile</a>
                            <a href="#">Settings</a>
                            <a href="logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
                <div class="menu-icon" onclick="toggleMenu()">☰</div>
            </nav>

        <?php else: ?>

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
                    <li class="nav-lines">|</li>
                    <li><a href="login.php">Login</a></li>
                    <li class="nav-lines">|</li>
                    <li><a href="signup.html">Sign Up</a></li>
                </ul>
                <div class="menu-icon" onclick="toggleMenu()">☰</div>
            </nav>

        <?php endif; ?>
    </header>
    <section class="shopHeader">
        <h2>Shop</h2>
        <div class="cart_div">
            <a href="cart.php"><img src="css_and_images/images/shopping-cart.png" />
                <?php
                    // To display cart icon
                    if(!empty($_SESSION["shopping_cart"])) 
                    {
                        $cart_count = count(array_keys($_SESSION["shopping_cart"]));
                ?>
                <span><?php echo $cart_count; ?></span>
                <?php
                }
                ?>
            </a>
        </div>
    </section>
    <section id="shop" class="shopContainer">
        <?php
        if(!empty($_SESSION["shopping_cart"]))
        {
            // Fetch the product codes in the shopping cart again after form submission
            $array_keys = array_keys($_SESSION["shopping_cart"]);
        }

        $result = mysqli_query($mysqli,"SELECT * FROM `products`");
        while($row = mysqli_fetch_assoc($result))
        {
            $code = $row['Code'];
            $itemStatus = in_array($code, $array_keys) ? "Added to cart" : "Add to cart";
            $buttonClass = $itemStatus === "Added to cart" ? "addedToCart" : "buy";

            echo "<div class='product_wrapper'>
                <form method='post' action=''>
                <input type='hidden' name='code' value=".$row['Code']." />
                <div class='image'><img src='".$row['Image']."' /></div>
                <div class='name'>".$row['Name']."</div>
                <div class='price'>$".$row['Price']."</div>
                <button type='submit' class='$buttonClass'>$itemStatus</button>
                </form>
                
                </div>";
        }
        mysqli_close($mysqli);
        ?>
    </section>

    <footer>
        <p>&copy; 2023 Cosmetic Brand. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/shop.js"></script>
    <script src="js/profilePic.js"></script>
</body>
</html>
