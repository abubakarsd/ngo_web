<?php
include_once('connect.php'); // Include your database connection file

$msg = '';
$error = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $priority_icon = isset($_POST['priority_icon']) ? trim($_POST['priority_icon']) : '';
    $priority_title = isset($_POST['priority_title']) ? trim($_POST['priority_title']) : '';
    $priority_text = isset($_POST['priority_text']) ? trim($_POST['priority_text']) : '';

    // Validate required fields
    if (empty($priority_icon) || empty($priority_title) || empty($priority_text)) {
        $error = "All fields are required.";
    } else {
        try {
            // Prepare SQL statement
            $stmt = $con->prepare("INSERT INTO priorities (icon, title, short_text, created_at) VALUES (:icon, :title, :short_text, NOW())");

            // Execute SQL with bound parameters
            $stmt->execute([
                ':icon' => $priority_icon,
                ':title' => $priority_title,
                ':short_text' => $priority_text
            ]);

            // Check if insertion was successful
            if ($stmt) {
                $msg = "Priority added successfully!";
            } else {
                $error = "Error adding priority.";
            }
        } catch (PDOException $e) {
            $error = "Database Error: " . $e->getMessage();
        }
    }
}

// Return response as JSON
echo json_encode(['msg' => $msg, 'error' => $error]);
?>
