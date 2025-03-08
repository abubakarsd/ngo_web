<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php'; // Ensure this points to your database connection file

$query = "SELECT `id`, `author`, `blog_image`, `blog_header`, `blog_details`, `date_post` FROM `tbl_blog` ORDER BY `date_post` DESC LIMIT 3";
$result = $conn->query($query);

$blogs = array();
while ($row = $result->fetch_assoc()) {
    $blogs[] = $row;
}

echo json_encode($blogs, JSON_PRETTY_PRINT);
?>