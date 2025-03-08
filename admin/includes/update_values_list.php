<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('connect.php'); // Include database connection

$msg = '';
$error = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $priority_id = $_POST["priority_id"] ?? '';
    $icon = $_POST["svg_icon"] ?? '';
    $title = $_POST["prio_title"] ?? '';
    $short_text = $_POST["short_text"] ?? ''; // Capture current timestamp

    // Validate required fields
    if (!empty($priority_id) && !empty($icon) && !empty($title) && !empty($short_text)) {
        try {
            // Update query
            $stmt = $con->prepare("UPDATE tbl_values SET icon = :icon, title = :title, details = :short_text WHERE id = :priority_id");
            $stmt->execute([
                ':icon' => $icon,
                ':title' => $title,
                ':short_text' => $short_text,
                ':priority_id' => $priority_id
            ]);

            $msg = "Values updated successfully.";
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    } else {
        $error = "All fields are required!";
    }

    // Return JSON response
    echo json_encode(['msg' => $msg, 'error' => $error]);
}
?>