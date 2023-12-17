<?php
    session_start();
    $status="";
    if (isset($_POST['action']) && $_POST['action']=="remove")
    {
    if(!empty($_SESSION["shopping_cart"])) 
    {
        foreach($_SESSION["shopping_cart"] as $key => $value) 
        {
            if($_POST["code"] == $key)
            {
                unset($_SESSION["shopping_cart"][$key]);
                $status = "<div class='box' style='color:red;'>
                Product is removed from your cart!</div>";
            }
            if(empty($_SESSION["shopping_cart"]))
                unset($_SESSION["shopping_cart"]);
            }		
        }
    }

    if (isset($_POST['action']) && $_POST['action']=="change")
    {
    foreach($_SESSION["shopping_cart"] as &$value)
    {
        if($value['code'] === $_POST["code"])
        {
            $value['quantity'] = $_POST["quantity"];
            break; // Stop the loop after we've found the product
        }
    }
        
    }
?>
<html>
<head>
    <title>Cart</title>
    <link rel='stylesheet' href='css_and_images/shopAndCartStyles.css' type='text/css' media='all' />
    <link rel="stylesheet" href="css_and_images/headerStyles.css">
    <link rel="stylesheet" href="css_and_images/styles.css">
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
    <div style="width:700px; margin:50 auto;">

        <h2>Cart</h2>   

        <?php
            if(!empty($_SESSION["shopping_cart"])) 
            {
            $cart_count = count(array_keys($_SESSION["shopping_cart"]));
        ?>
        <?php
            }
        ?>

        <div class="cart">
            <?php
            if(isset($_SESSION["shopping_cart"]))
            {
                $total_price = 0;
            ?>	
            <table class="table">
                <tbody>
                    <tr>
                    <td></td>
                        <td>Product Name</td>
                        <td>Quantity</td>
                        <td>Price</td>
                        <td>Total Price</td>
                    </tr>	
                    <?php		
                    foreach ($_SESSION["shopping_cart"] as $product)
                    {
                    ?>
                    <tr>
                    <td><img src='<?php echo $product["image"]; ?>'/></td>
                    <td><?php echo $product["name"]; ?><br />
                    <form method='post' action=''>
                        <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                        <input type='hidden' name='action' value="remove" />
                        <button type='submit' class='remove'>Remove Item</button>
                    </form>
                    </td>
                    <td>
                    <form method='post' action=''>
                        <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                        <input type='hidden' name='action' value="change" />
                        <select name='quantity' class='quantity' onchange="this.form.submit()">
                        <option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
                        <option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
                        <option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
                        <option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
                        <option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
                        </select>
                    </form>
                    </td>
                    <td><?php echo "$".$product["price"]; ?></td>
                    <td><?php echo "$".$product["price"]*$product["quantity"]; ?></td>
                    </tr>
                    <?php
                    $total_price += ($product["price"]*$product["quantity"]);
                    }
                    ?>
                    <tr>
                        <td colspan="5" align="right">
                            <strong>TOTAL: <?php echo "$".$total_price; ?></strong>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a href="checkout.php">
                <button class='remove'>Checkout</button>
            </a>
            <?php
            }
            else
            {
                echo "<h3>Your cart is empty! <br> <a href='shop.php'>Go to shop</a></h3>";
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/profilePic.js"></script>
</body>
</html>