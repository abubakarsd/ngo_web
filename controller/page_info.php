<?php
header("Content-Type: application/json");

// Include database connection
require_once "connection.php";

$sql = "SELECT `page_info`, `mission`, `vission`, `phone_number`, `page_email`, `page_address`, `media_facebook`, `media_twiter`, `media_ig`, linkedin FROM `tbl_page_info` LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(["error" => "No data found"]);
}

?>
