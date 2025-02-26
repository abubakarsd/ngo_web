<?php
header("Content-Type: application/json");

// Include database connection
require_once "connection.php";

// Fetch carousel items
$sql = "SELECT id, img, header_text, sub_header_text, date_added FROM carousel_item";
$result = $conn->query($sql);

$slides = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $slides[] = [
            "image" => $row["img"],
            "title" => $row["header_text"],
            "description" => $row["sub_header_text"]
        ];
    }
}

// Close connection
$conn->close();

// Return JSON response
echo json_encode($slides);
?>
