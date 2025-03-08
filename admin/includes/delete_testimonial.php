<?php
// Include your database connection file
include_once('connect.php');

// Check if donation ID is provided
if(isset($_POST['testID'])) {
    // Sanitize the input to prevent SQL injection
    $test_id = filter_var($_POST['testID'], FILTER_SANITIZE_NUMBER_INT);

    // Prepare and execute SQL query to delete the donation
    $stmt = $con->prepare("DELETE FROM testimonials WHERE id = :testID");
    $stmt->execute([':testID' =>$test_id]);

} else {
    // Return error message if donation ID is not provided
    echo json_encode(array('success' => false, 'message' => 'Testimonial ID not provided.'));
}
?>