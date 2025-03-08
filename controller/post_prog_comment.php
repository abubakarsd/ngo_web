<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $progID = isset($_POST['progID']) ? intval($_POST['progID']) : 0;
    $name = isset($_POST['name']) ? trim($_POST['name']) : "";
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $message = isset($_POST['message']) ? trim($_POST['message']) : "";
    
    if ($progID > 0 && !empty($name) && !empty($email) && !empty($message)) {
        // Check database connection
        if (!$conn) {
            die(json_encode(["success" => false, "message" => "Database connection failed!"]));
        }

        // Prepare SQL Statement
        $query = "INSERT INTO program_comments (progID, commentor_name, commentor_email, commentor_post, comments_date) 
                  VALUES (?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($query);

        // Check if statement was prepared correctly
        if (!$stmt) {
            die(json_encode(["success" => false, "message" => "SQL Prepare Failed: " . $conn->error]));
        }

        // Bind parameters
        $stmt->bind_param("isss", $progID, $name, $email, $message);

        // Execute and check if it runs successfully
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Comment posted successfully"]);
        } else {
            die(json_encode(["success" => false, "message" => "SQL Execution Failed: " . $stmt->error]));
        }
    } else {
        echo json_encode(["success" => false, "message" => "All fields are required"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>