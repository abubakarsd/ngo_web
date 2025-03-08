<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php';
header('Content-Type: application/json');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(["success" => false, "message" => "Blog ID is required"]);
    exit;
}

$blogID = intval($_GET['id']);

$query = "SELECT id, author, blog_image, blog_header, blog_details, date_post FROM tbl_blog WHERE id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Database error: " . $conn->error]);
    exit;
}

$stmt->bind_param("i", $blogID);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode([
        "success" => true,
        "blog" => [
            "author" => $row['author'],
            "blog_image" => "/ngo_web/static/media/" . $row['blog_image'],
            "blog_header" => $row['blog_header'],
            "blog_details" => htmlspecialchars_decode($row['blog_details']), // Allow HTML content
            "date_post" => date("jS M Y", strtotime($row['date_post'])) // Format date
        ]
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Blog not found"]);
}
?>
