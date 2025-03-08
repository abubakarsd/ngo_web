<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('connect.php'); // Include database connection

$msg = '';
$error = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resource_name = $_POST["resource_name"] ?? '';
    $image_type = $_POST["image_type"] ?? '';
    $resource_link = $_POST["resource_link"] ?? '';
    $file_name = ''; // Always define $file_name

    // File upload handling
    if (!empty($_FILES["file"]["name"])) {
        $uploadOk = 1;
        $target_dir = "../../static/media/"; // Folder for uploads
        $imageFileType = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
        $file_name = time() . "_" . basename($_FILES["file"]["name"]); // Unique file name
        $target_file = $target_dir . $file_name;

        // Validate file size (5MB limit)
        if ($_FILES["file"]["size"] > 5000000) {
            $error = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow only specific file formats
        $allowed_formats = array("jpg", "png", "jpeg", "gif");
        if (!in_array($imageFileType, $allowed_formats)) {
            $error = "Invalid file format. Only JPG, JPEG, PNG & GIF allowed.";
            $uploadOk = 0;
        }

        // Upload file if no errors
        if ($uploadOk == 1) {
            if (!move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $error = "File upload failed. Check folder permissions.";
                $file_name = ''; // Reset file name if upload fails
            }
        } else {
            $file_name = ''; // Ensure it's empty if upload fails
        }
    }

    // Only insert if all required fields are filled
    if (empty($error) && !empty($resource_name) && !empty($image_type) && !empty($resource_link) && !empty($file_name)) {
        try {
            $stmt = $con->prepare("INSERT INTO tbl_resource (resource_img, resource_name, type_resource, post_date, resource_link) 
                                   VALUES (:resource_img, :resource_name, :image_type, NOW(), :resource_link)");

            $stmt->execute([
                ':resource_img' => $file_name,
                ':resource_name' => $resource_name,
                ':image_type' => $image_type,
                ':resource_link' => $resource_link
            ]);

            $msg = "Resource added successfully.";
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    } else {
        $error = "All fields and image upload are required!";
    }

    // Return JSON response
    echo json_encode(['msg' => $msg, 'error' => $error]);
}
?>