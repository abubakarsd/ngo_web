<?php
include_once('connect.php'); // Include your database connection file
$msg = '';
$error = '';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $team_type = $_POST["team_type"] ?? '';
    $team_name = $_POST["team_name"] ?? '';
    $team_position = $_POST["team_position"] ?? '';
    $team_fb_handle = $_POST["team_fb_handle"] ?? '';
    $team_tl_handle = $_POST["team_tl_handle"] ?? '';
    $team_in_handle = $_POST["team_in_handle"] ?? '';
    $team_email_address = $_POST["team_email_address"] ?? '';
    $about_team_text = $_POST["about_team_text"] ?? '';
    $team_instagram_handle = $_POST["team_instagram_handle"] ?? '';
    $target_file = "default.jpg"; // Default image

    // File upload handling
    if (!empty($_FILES["file"]["name"])) {
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));

        // Check file size (limit to 5MB)
        if ($_FILES["file"]["size"] > 5000000) {
            $error = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow only certain image formats
        if (!in_array($imageFileType, array("jpg", "png", "jpeg", "gif"))) {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Proceed if no errors
        if ($uploadOk == 1) {
            $newFileName = time() . "_" . basename($_FILES["file"]["name"]);
            $uploadPath = "../../static/media/" . $newFileName;

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadPath)) {
                $target_file = $newFileName; // Assign uploaded file name
            } else {
                $error = "Error uploading your file.";
            }
        }
    }

    // Proceed only if there's no upload error
    if (empty($error)) {
        // Prepare and execute SQL query to insert data
        $stmt = $con->prepare("INSERT INTO tbl_team (team_type, team_image, team_name, team_position, about_team, facebook_link, x_link, email_address, instagram_link, in_link) 
        VALUES (:team_type, :teamimg, :team_name, :team_position, :about_team_text, :team_fb_handle, :team_tl_handle, :team_email_address, :team_instagram_handle, :team_in_handle)");

        $stmt->execute([
            ':team_type' => $team_type,
            ':teamimg' => $target_file,
            ':team_name' => $team_name,
            ':team_position' => $team_position,
            ':about_team_text' => $about_team_text,
            ':team_fb_handle' => $team_fb_handle,
            ':team_tl_handle' => $team_tl_handle,
            ':team_email_address' => $team_email_address,
            ':team_instagram_handle' => $team_instagram_handle,
            ':team_in_handle' => $team_in_handle
        ]);

        // Check if the query was successful
        if ($stmt) {
            $msg = "Team member uploaded successfully.";
        } else {
            $error = "Error uploading information.";
        }
    }

    // Return response as JSON
    echo json_encode(['msg' => $msg, 'error' => $error]);
}
?>