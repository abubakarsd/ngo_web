<?php
include_once('connect.php'); // Include your database connection file

header('Content-Type: application/json');

if (!isset($_POST['testID']) || empty($_POST['testID'])) {
    echo json_encode(["success" => false, "message" => "Testimonial ID is required"]);
    exit;
}

$testID = intval($_POST['testID']); // Securely handle input

try {
    $sql = $con->prepare("SELECT `id`, `title`, `text`, `name`, `role`, `image`, `rating`, `created_at` FROM `testimonials` WHERE id = :testID LIMIT 1");
    $sql->execute([':testID' => $testID]);
    $row = $sql->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        echo json_encode([
            "success" => true,
            "id" => $row["id"],
            "title" => $row["title"],
            "text" => htmlspecialchars_decode($row["text"]),
            "name" => $row["name"],
            "role" => $row["role"],
            "image" => "/uploads/" . $row["image"],
            "rating" => $row["rating"],
            "created_at" => $row["created_at"]
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Testimonial not found"]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
?>