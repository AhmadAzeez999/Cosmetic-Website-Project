<?php
    include('db.php');

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($name)) 
    {
        die("Name is required");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        die("Valid email is required");
    }

    if (strlen($password) < 8) {
        die("Password must be at least 8 characters");
    }

    if (!preg_match("/[a-z]/i", $password)) 
    {
        die("Password must contain at least one letter");
    }

    if (!preg_match("/[0-9]/", $password)) 
    {
        die("Password must contain at least one number");
    }

    if ($password !== $_POST["password_confirmation"]) 
    {
        die("Passwords must match");
    }

    // Using password_hash for security
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Prepared statement to avoid SQL injection attacks
    $sql = "INSERT INTO users (name, email, password_hash)
            VALUES (?, ?, ?)";

    $stmt = $mysqli->stmt_init();

    // If prepare() returns false, then there's an error with the SQL
    if (!$stmt->prepare($sql)) 
    {
        die("SQL error: " . $stmt->error);
    }

    $stmt->bind_param("sss", $name, $email, $password_hash);

    try 
    {
        if ($stmt->execute()) 
        {
            header("Location: login.php");
            exit;
        } 
        else 
        {
            throw new Exception("Error executing the statement: " . $stmt->error);
        }
    } 
    catch (Exception $e) 
    {
        if ($stmt->errno === 1062) 
        {
            die("Email already taken");
        } 
        else 
        {
            die("Error: " . $e->getMessage());
        }
    }
?>
