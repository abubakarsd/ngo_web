<?php
include 'connection.php';
header('Content-Type: application/json');

if (!isset($_GET['progID']) || empty($_GET['progID'])) {
    echo json_encode(["success" => false, "message" => "Program ID is required"]);
    exit;
}

$progID = intval($_GET['progID']);

$query = "SELECT id, commentor_name, commentor_post, comments_date FROM program_comments WHERE progID = ? ORDER BY comments_date DESC";
$stmt = $conn->prepare($query);

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Database error: " . $conn->error]);
    exit;
}

$stmt->bind_param("i", $progID);
$stmt->execute();
$result = $stmt->get_result();

$comments = [];
while ($row = $result->fetch_assoc()) {
    $comments[] = $row;
}

if (count($comments) > 0) {
    echo json_encode(["success" => true, "comments" => $comments]);
} else {
    echo json_encode(["success" => true, "comments" => [], "message" => "No comments found"]);
}
?>