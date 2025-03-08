<?php
include_once "connection.php"; // Ensure this file contains your database connection

$sql = "SELECT * FROM tbl_team WHERE team_type = 2";
$result = $conn->query($sql);

$teamMembers = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $teamMembers[] = $row;
    }
}

echo json_encode($teamMembers);
?>
