<?php
include 'connection.php';

$query = "SELECT id, program_head FROM tbl_program ORDER BY date_added DESC LIMIT 5";
$result = $conn->query($query);

$programs = [];
while ($row = $result->fetch_assoc()) {
    $programs[] = $row;
}

if (!empty($programs)) {
    echo json_encode(["success" => true, "data" => $programs]);
} else {
    echo json_encode(["success" => false, "message" => "No programs found"]);
}
?>