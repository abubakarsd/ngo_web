<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php';
header('Content-Type: application/json');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(["success" => false, "message" => "Team ID is required"]);
    exit;
}

$teamID = intval($_GET['id']);

$query = "SELECT id, team_image, team_name, team_position, about_team, facebook_link, x_link, email_address, instagram_link, in_link FROM tbl_team WHERE id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Database error: " . $conn->error]);
    exit;
}

$stmt->bind_param("i", $teamID);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Ensure HTML tags in description are preserved
    echo json_encode([
        "success" => true,
        "program" => [
            "team_image" => "/ngo_web/static/media/" . $row['team_image'],
            "team_name" => $row['team_name'],
            "team_position" => $row['team_position'],
            "about_team" => htmlspecialchars_decode($row['about_team']),
            "facebook_link" => $row['facebook_link'],
            "x_link" => $row['x_link'],
            "email_address" => $row['email_address'],
            "instagram_link" => $row['instagram_link'],
            "in_link" => $row['in_link']
        ]
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Team not found"]);
}
?>