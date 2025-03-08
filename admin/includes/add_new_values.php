<?php
include_once('connect.php'); // Include your database connection file

$msg = '';
$error = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $svg_icon = isset($_POST['svg_icon']) ? trim($_POST['svg_icon']) : '';
    $prio_title = isset($_POST['prio_title']) ? trim($_POST['prio_title']) : '';
    $short_text = isset($_POST['short_text']) ? trim($_POST['short_text']) : '';

    // Validate required fields
    if (empty($svg_icon) || empty($prio_title) || empty($short_text)) {
        $error = "All fields are required.";
    } else {
        try {
            // Prepare SQL statement
            $stmt = $con->prepare("INSERT INTO tbl_values (icon, title, details) VALUE (:icon, :title, :short_text)");

            // Execute SQL with bound parameters
            $stmt->execute([
                ':icon' => $svg_icon,
                ':title' => $prio_title,
                ':short_text' => $short_text
            ]);

            // Check if insertion was successful
            if ($stmt) {
                $msg = "Values added successfully!";
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