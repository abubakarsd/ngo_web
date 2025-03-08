<?php
// Include your database connection file
include_once('connect.php');

// Check if donation ID is provided
if(isset($_POST['priorityid'])) {
    // Sanitize the input to prevent SQL injection
    $priorityid = filter_var($_POST['priorityid'], FILTER_SANITIZE_NUMBER_INT);

    // Prepare and execute SQL query to delete the donation
    $stmt = $con->prepare("DELETE FROM priorities WHERE id = :priorityid");
    $stmt->execute([':priorityid' =>$priorityid]);

    // Check if the query was successful
    if ($stmt) {
        // Return success message
        echo json_encode(array('success' => true, 'message' => 'Priority deleted successfully.'));
    } else {
        // Return error message
        echo json_encode(array('success' => false, 'message' => 'Error deleting Priority.'));
    }
} else {
    // Return error message if donation ID is not provided
    echo json_encode(array('success' => false, 'message' => 'Priority ID not provided.'));
}
?>