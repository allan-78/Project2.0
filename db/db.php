<?php
$servername = "localhost";
$username = "db_user";
$password = "db_pass";
$dbname = "database_name";

// Create connection with error handling
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
