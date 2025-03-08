<?php
header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
include_once "connection.php";

// Set number of blogs per page
$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch total number of blogs
$totalQuery = "SELECT COUNT(*) as total FROM tbl_program";
$totalResult = $conn->query($totalQuery);

if (!$totalResult) {
    die(json_encode(["error" => "Database Error: " . $conn->error]));
}

$totalRow = $totalResult->fetch_assoc();
$totalBlogs = $totalRow['total'];
$totalPages = ceil($totalBlogs / $limit);

// Fetch paginated blog records
$sql = "SELECT id, program_img, program_head, prog_location, prog_date, prog_discription 
        FROM tbl_program 
        ORDER BY date_added DESC 
        LIMIT $limit OFFSET $offset";
        
$result = $conn->query($sql);

if (!$result) {
    die(json_encode(["error" => "Database Error: " . $conn->error]));
}

$blogs = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $blogs[] = [
            "id" => $row["id"],
            "program_img" => $row["program_img"],
            "program_head" => $row["program_head"],
            "program_detail_url" => "/ngo_web/project-detail?id=" . $row["id"],
            "days" => $row["prog_date"],
            "prog_location" => $row["prog_location"],
            "prog_discription" => $row["prog_discription"]
        ];
    }
}

$conn->close();

// Return JSON response with pagination details
echo json_encode([
    "blogs" => $blogs,
    "current_page" => $page,
    "total_pages" => $totalPages
]);
?>