<?php
include 'connection.php';

$query = "SELECT resource_img, resource_name, resource_link FROM tbl_resource ORDER BY post_date DESC";
$result = $conn->query($query);

$resources = array();
while ($row = $result->fetch_assoc()) {
    $resources[] = $row;
}

// Send JSON response
echo json_encode($resources);
?>