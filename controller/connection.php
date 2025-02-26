<?php
// Database connection settings
$host = "localhost"; // Change if using a remote database
$username = "root";
$password = "";
$database = "tlwdfoun_tlwdfoundation";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>