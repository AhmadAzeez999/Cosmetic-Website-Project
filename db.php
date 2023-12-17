<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "maindatabase";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno)
{
	echo "Failed to connect to MySQL: " . $con->connect_error;
	die();
}
?>