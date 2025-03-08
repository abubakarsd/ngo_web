<?php
header("Content-Type: application/json");

// Database connection
include_once "connection.php";

// Fetch team members
$sql = "SELECT * FROM tbl_team WHERE team_type = 1";
$result = $conn->query($sql);

$team = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $team[] = [
            "id" => $row["id"],
            "name" => $row["team_name"],
            "position" => $row["team_position"],
            "image" => $row["team_image"],  // Ensure this stores the correct image path
            "facebook" => $row["facebook_link"],
            "twitter" => $row["x_link"],
            "linkedin" => $row["in_link"]
        ];
    }
}

// Close connection
$conn->close();

// Return JSON response
echo json_encode($team);
?>