<?php
header("Content-Type: application/json");

// Database connection
include_once "connection.php";

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

// Fetch only 3 records from the database
$sql = "SELECT * FROM tbl_values ORDER BY date_add DESC";
$result = $conn->query($sql);

$priorities = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $priorities[] = [
            "id" => $row["id"],
            "icon" => $row["icon"],  // Store SVG path or URL
            "title" => $row["title"],
            "short_text" => $row["details"]
        ];
    }
}

// Close connection
$conn->close();

// Return JSON response
echo json_encode($priorities);
?>