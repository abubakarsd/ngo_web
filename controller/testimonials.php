<?php
header("Content-Type: application/json");

// Database connection settings
include_once "connection.php";

// Fetch testimonials from the database
$sql = "SELECT title, text, name, role, image, rating FROM testimonials ORDER BY id DESC";
$result = $conn->query($sql);

$testimonials = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $testimonials[] = [
            "title" => $row["title"],
            "text" => $row["text"],
            "name" => $row["name"],
            "role" => $row["role"],
            "image" => $row["image"],
            "rating" => (int) $row["rating"] // Ensuring rating is an integer
        ];
    }
}

// Close connection
$conn->close();

// Return JSON response
echo json_encode($testimonials);
?>
