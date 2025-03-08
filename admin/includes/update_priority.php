<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('connect.php'); // Include database connection

$msg = '';
$error = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $priority_id = $_POST["priority_id"] ?? '';
    $prior_id = $_POST["priority_type"] ?? '';
    $page_discription = $_POST["short_text"] ?? '';
    $file_name = ''; // Always define file_name

    // File upload handling
    if (!empty($_FILES["page_img"]["name"])) {
        $uploadOk = 1;
        $target_dir = "../../static/media/"; // Folder for uploads
        $imageFileType = strtolower(pathinfo($_FILES["page_img"]["name"], PATHINFO_EXTENSION));
        $file_name = time() . "_" . basename($_FILES["page_img"]["name"]); // Unique file name
        $target_file = $target_dir . $file_name;

        // Validate file size (5MB limit)
        if ($_FILES["page_img"]["size"] > 5000000) {
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
            if (!move_uploaded_file($_FILES["page_img"]["tmp_name"], $target_file)) {
                $error = "File upload failed. Check folder permissions.";
                $file_name = ''; // Reset file name if upload fails
            }
        } else {
            $file_name = ''; // Ensure it's empty if upload fails
        }
    }

    // Only update if all required fields are filled
    if (empty($error) && !empty($priority_id) && !empty($prior_id) && !empty($page_discription)) {
        try {
            if (!empty($file_name)) {
                // Update with new image
                $stmt = $con->prepare("UPDATE tbl_priority SET prior_id = :prior_id, page_img = :page_img, page_discription = :page_discription WHERE id = :priority_id");
                $stmt->execute([
                    ':prior_id' => $prior_id,
                    ':page_img' => $file_name,
                    ':page_discription' => $page_discription,
                    ':priority_id' => $priority_id
                ]);
            } else {
                // Update without changing the image
                $stmt = $con->prepare("UPDATE tbl_priority SET prior_id = :prior_id, page_discription = :page_discription WHERE id = :priority_id");
                $stmt->execute([
                    ':prior_id' => $prior_id,
                    ':page_discription' => $page_discription,
                    ':priority_id' => $priority_id
                ]);
            }

            $msg = "Priority updated successfully.";
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