<?php
    include('db.php');

    $is_invalid = false;

    if ($_SERVER["REQUEST_METHOD"] === "POST")
    {
        $sql = sprintf("SELECT * FROM users
                        WHERE email = '%s'",
                        $mysqli->real_escape_string($_POST["email"]));

        $result = $mysqli->query($sql);

        $user = $result->fetch_assoc();

        if ($user)
        {
            if(password_verify($_POST["password"], $user["password_hash"]))
            {
                session_start();

                session_regenerate_id();

                $_SESSION["user_id"] = $user["ID"];

                header("Location: index.php");
                exit;
            }
        }

        $is_invalid = true;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css_and_images/login.css">
    <link rel="stylesheet" href="css_and_images/headerStyles.css">
    <title>Login</title>
</head>
<body>
    <header class="header-container">
        <a href="index.php">
            <img class="headerImg" src="css_and_images/images/Logo.png" alt="Company logo">
        </a>
    </header>

    <main>
        <div class="formContainer">
            <h1> Login </h1>
            <?php if ($is_invalid): ?>
                <em>Invalid email or password </em>
            <?php endif; ?>
            <form method="post">
                <label for="email"> Email: </label>
                <input type="email" name="email" id="email" placeholder="Enter your email"
                        value="<?= htmlspecialchars($_POST["email"] ?? "")?>">

                <label for="password"> Password: </label>
                <input type="password" name="password" id="password">

                <button name="login"> Login </button>
            </form>

            <p> Don't have an account? 
                <a href="signup.html"> Click here to sign in </a>
            </p>
        </div>
    </main>
</body>
</html>