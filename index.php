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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css_and_images/styles.css">
    <link rel="stylesheet" href="css_and_images/headerStyles.css">
    <link rel="stylesheet" href="css_and_images/footerStyles.css">
    <link rel="stylesheet" href="css_and_images/carouselStyles.css">
    <title>Cosmetic Brand</title>
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
    
    <section id="hero">
        <h1>Welcome to Cosmetico</h1>
        <p>Discover Beauty in Every Shade</p>
        <a href="shop.php" class="buttons">Explore Products</a>
    </section>

    <section id="highlights">
        <h2>Discover the Art of Beautiful Secrets</h2>
        <div class="carousel-container">
            <ul class="slides">
              <li><img src="css_and_images/images/Cosmetic 1.jpg" alt="Slide 1"></li>
              <li><img src="css_and_images/images/Cosmetic 2.jpg" alt="Slide 2"></li>
              <li><img src="css_and_images/images/Cosmetic 3.jpg" alt="Slide 3"></li>
              <li><img src="css_and_images/images/Cosmetic 4.jpg" alt="Slide 3"></li>
            </ul>
            <div class="dots-navigation"></div>
          </div>
    </section>

    <section id="products">
        <h2>Our Latest Products</h2>
        <div class="product">
            <img src="css_and_images/images/Product 1.jpg" alt="Product 1">
            <h3>Body cream 1</h3>
            <p>A nice body cream with antioxidants</p>
        </div>
        <div class="product">
            <img src="css_and_images/images/Product 2.jpg" alt="Product 2">
            <h3>Body cream 2</h3>
            <p>A nice body cream with pH Adjusters</p>
        </div>
    </section>

    <section id="about">
        <h2>About Us</h2>
        <p>Welcome to Cosmetico – your beauty destination! We're more than just a brand; 
            we're a beauty experience. At Cosmetico, we blend passion with innovation to bring 
            you top-tier beauty solutions. Our mission at Cosmetico is simple: to redefine 
            beauty standards and empower you to feel confident in your own skin. With a focus
             on quality and customer satisfaction, we're here to enhance your beauty journey.
        </p>
        <img src="css_and_images/images/aboutUsImg.jpg">
    </section>

    <section id="contact">
        <h2>Contact Us</h2>
        <p>Have questions or feedback? Reach out to us.</p>
        <a href="contact.html" class="buttons">Contact</a>
    </section>

    <footer>
        <p>&copy; 2023 Cosmetic Brand. All rights reserved.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/profilePic.js"></script>
    <script src="js/carouselScript.js"></script>
</body>
</html>
