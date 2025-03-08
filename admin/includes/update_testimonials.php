<?php
include_once('connect.php'); // Include your database connection file
$msg = '';
$error = '';

// Function to resize image
function resizeImage($sourcePath, $targetPath, $maxWidth = 800, $maxHeight = 600)
{
    list($width, $height, $imageType) = getimagesize($sourcePath);

    // Calculate the new dimensions
    $ratio = min($maxWidth / $width, $maxHeight / $height);
    $newWidth = $width * $ratio;
    $newHeight = $height * $ratio;

    // Create a new true color image
    $newImage = imagecreatetruecolor($newWidth, $newHeight);

    // Create the appropriate image resource based on file type
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $sourceImage = imagecreatefromjpeg($sourcePath);
            break;
        case IMAGETYPE_PNG:
            $sourceImage = imagecreatefrompng($sourcePath);
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            break;
        case IMAGETYPE_GIF:
            $sourceImage = imagecreatefromgif($sourcePath);
            break;
        default:
            return false; // Unsupported format
    }

    // Resize the image
    imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    // Save the resized image
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            imagejpeg($newImage, $targetPath, 85); // 85% quality
            break;
        case IMAGETYPE_PNG:
            imagepng($newImage, $targetPath, 8); // Compression level 8
            break;
        case IMAGETYPE_GIF:
            imagegif($newImage, $targetPath);
            break;
    }

    // Free memory
    imagedestroy($newImage);
    imagedestroy($sourceImage);

    return true;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $testimonial_id = $_POST['testimonial_id'];
    $testimonial_title = $_POST['testimonial_title'];
    $testimonial_name = $_POST['testimonial_name'];
    $testimonial_role = $_POST['testimonial_role'];
    $testimonial_rating = $_POST['testimonial_rating'];
    $testimonial_details = $_POST['testimonial_details']; // Rich text editor content
    $target_file = ''; // Initialize $target_file as an empty string

    // File upload handling
    if (!empty($_FILES["file"]["name"])) {
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
        $target_file = "../../static/media/" . basename($_FILES["file"]["name"]);
    
        // Check file size
        if ($_FILES["file"]["size"] > 5000000) { // 5MB limit
            $error = "File is too large. Max size: 5MB";
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        if (!in_array($imageFileType, array("jpg", "png", "jpeg", "gif"))) {
            $error = "Invalid file format. Allowed formats: JPG, JPEG, PNG, GIF";
            $uploadOk = 0;
        }
    
        // Attempt to move file if all checks pass
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $msg = "File uploaded successfully: " . basename($_FILES["file"]["name"]);
            } else {
                $error = "File upload failed. Error details: " . print_r(error_get_last(), true);
                error_log("Upload Error: " . print_r(error_get_last(), true)); // Log error to server logs
            }
        }
    }
    

    // Proceed only if there's no upload error
    if (empty($error)) {
        // Prepare and execute SQL query to update testimonial information
        $stmt = $con->prepare("UPDATE testimonials SET 
                                image = :testimonial_img, 
                                title = :testimonial_title, 
                                text = :testimonial_details, 
                                name = :testimonial_name, 
                                role = :testimonial_role,
                                rating = :testimonial_rating
                                WHERE id = :testimonial_id");

        // Execute query with bind parameters
        $stmt->execute([
            ':testimonial_img' => $target_file,
            ':testimonial_title' => $testimonial_title,
            ':testimonial_details' => $testimonial_details,
            ':testimonial_name' => $testimonial_name,
            ':testimonial_role' => $testimonial_role,
            ':testimonial_rating' => $testimonial_rating,
            ':testimonial_id' => $testimonial_id
        ]);

        // Check if the query was successful
        if ($stmt) {
            $msg = "Testimonial updated successfully.";
        } else {
            $error = "Error updating testimonial.";
        }
    }

    // Return the response as JSON
    echo json_encode(['msg' => $msg, 'error' => $error]);
}
?>