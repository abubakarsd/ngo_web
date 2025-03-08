<?php
include_once('connect.php'); // Include your database connection file
$msg = '';
$error = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $program_title = $_POST['program_title'];
    $priority_type = $_POST['priority_type'];
    $program_date = $_POST['program_date'];
    $program_location = $_POST['program_location'];
    $program_description = $_POST['program_description']; // Rich text editor content
    $target_file = ''; // Initialize $target_file as an empty string

    // File upload handling
    if (!empty($_FILES["file"]["name"])) {
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));

        // Check file size
        if ($_FILES["file"]["size"] > 5000000) { // 5MB limit
            $error = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, array("jpg", "png", "jpeg", "gif"))) {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $error = "Sorry, your file was not uploaded.";
        } else {
            // Get just the file name without the directory path
            $target_file = basename($_FILES["file"]["name"]);

            if (move_uploaded_file($_FILES["file"]["tmp_name"], "../../static/media/" . $target_file)) {
                $msg = "The file " . $target_file . " has been uploaded.";
            } else {
                $error = "Sorry, there was an error uploading your file.";
                $target_file = ''; // Reset $target_file in case of upload error
            }
        }
    }

    // Proceed only if there's no upload error
    if (empty($error)) {
    // Prepare and execute SQL query to update donation information
    $stmt = $con->prepare("INSERT INTO tbl_program (priority_id, program_img, program_head, prog_location, prog_date, prog_discription) VALUES (:priorityID, :program_img, :program_head, :prog_location, :prog_date, :prog_discription)");

    // Bind parameters
    $stmt->execute(
        array(
            ':priorityID' => $priority_type,  // Assuming priority_type is an integer in the database table
            ':program_img' => $target_file,
            ':program_head' => $program_title,
            ':prog_location' => $program_location,
            ':prog_date' => $program_date,
            ':prog_discription' => $program_description
            )
    );

    // Check if the query was successful
    if ($stmt) {
        $msg = "Program information uploaded successfully.";
    } else {
        $error = "Error updating donation information.";
    }
    }

    // Return the response as JSON
    echo json_encode(array('msg' => $msg, 'error' => $error));
}
?>