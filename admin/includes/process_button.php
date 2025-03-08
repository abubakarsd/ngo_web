<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('connect.php'); // Database connection

$msg = '';
$error = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $btn_text = $_POST["txt_btn_text"] ?? '';
    $btn_style = $_POST["btn_style"] ?? '';

    // Ensure non-null values for txt_internal & txt_external
    if ($btn_style == '1') { // Internal Link Selected
        $txt_internal = $_POST["txt_internal"] ?? '';
        $txt_external = ''; // Set external to empty string
    } else { // External Link Selected
        $txt_external = $_POST["txt_external"] ?? '';
        $txt_internal = ''; // Set internal to empty string
    }

    // Set default image for internal links
    $file_name = ($btn_style == '1') ? 'default.jpg' : '';

    // Handle file upload for internal link
    if ($btn_style == '1' && !empty($_FILES["internal_img"]["name"])) {
        $uploadOk = 1;
        $target_dir = "../../static/media/"; // Adjust upload directory
        $imageFileType = strtolower(pathinfo($_FILES["internal_img"]["name"], PATHINFO_EXTENSION));
        $file_name = time() . "_" . basename($_FILES["internal_img"]["name"]);
        $target_file = $target_dir . $file_name;

        // Validate file size (5MB max)
        if ($_FILES["internal_img"]["size"] > 5000000) {
            $error = "File is too large!";
            $uploadOk = 0;
        }

        // Allow only specific file formats
        $allowed_formats = array("jpg", "png", "jpeg", "gif");
        if (!in_array($imageFileType, $allowed_formats)) {
            $error = "Invalid file format. Only JPG, JPEG, PNG & GIF allowed.";
            $uploadOk = 0;
        }

        // Upload file
        if ($uploadOk == 1) {
            if (!move_uploaded_file($_FILES["internal_img"]["tmp_name"], $target_file)) {
                $error = "File upload failed!";
                $file_name = 'default.jpg'; // Default image in case of failure
            }
        } else {
            $file_name = 'default.jpg'; // Default image in case of failure
        }
    }

    // Proceed only if there are no errors
    if (empty($error) && !empty($btn_text)) {
        try {
            // Check if any record exists
            $stmt_check = $con->query("SELECT COUNT(*) FROM tbl_dynamic_button");
            $record_exists = $stmt_check->fetchColumn();

            if ($record_exists > 0) {
                // Update first existing record**
                $stmt = $con->prepare("UPDATE tbl_dynamic_button 
                                       SET btn_text = :btn_text, 
                                           btn_style = :btn_style, 
                                           txt_external = :txt_external, 
                                           internal_img = :internal_img, 
                                           txt_internal = :txt_internal 
                                       LIMIT 1");
                $stmt->execute([
                    ':btn_text' => $btn_text,
                    ':btn_style' => $btn_style,
                    ':txt_external' => $txt_external, // Always non-null
                    ':internal_img' => $file_name, // Always non-null
                    ':txt_internal' => $txt_internal // Always non-null
                ]);
                $msg = "Button updated successfully!";
            } else {
                // Insert new record**
                $stmt = $con->prepare("INSERT INTO tbl_dynamic_button (btn_text, btn_style, txt_external, internal_img, txt_internal) 
                                       VALUES (:btn_text, :btn_style, :txt_external, :internal_img, :txt_internal)");
                $stmt->execute([
                    ':btn_text' => $btn_text,
                    ':btn_style' => $btn_style,
                    ':txt_external' => $txt_external, // Always non-null
                    ':internal_img' => $file_name, // Always non-null
                    ':txt_internal' => $txt_internal // Always non-null
                ]);
                $msg = "Button saved successfully!";
            }
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