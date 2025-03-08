<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php';
header('Content-Type: application/json');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(["success" => false, "message" => "Program ID is required"]);
    exit;
}

$progID = intval($_GET['id']);

$query = "SELECT id, program_img, program_head, prog_location, prog_date, prog_discription FROM tbl_program WHERE id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Database error: " . $conn->error]);
    exit;
}

$stmt->bind_param("i", $progID);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Ensure HTML tags in description are preserved
    echo json_encode([
        "success" => true,
        "program" => [
            "program_img" => "/ngo_web/static/media/" . $row['program_img'],
            "program_head" => $row['program_head'],
            "prog_location" => $row['prog_location'],
            "prog_date" => $row['prog_date'],
            "prog_discription" => htmlspecialchars_decode($row['prog_discription'])
        ]
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Program not found"]);
}
?>