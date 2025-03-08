<?php
header("Content-Type: application/json");

// Database connection
include_once "connection.php";

// Fetch partners from database
$sql = "SELECT * FROM tbl_partners"; // Adjust table name if needed
$result = $conn->query($sql);

$partners = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $partners[] = [
            "id" => $row["id"],
            "logo" => $row["pertner_img"]
        ];
    }
}

// Close connection
$conn->close();

// Return JSON response
echo json_encode($partners);
?>
