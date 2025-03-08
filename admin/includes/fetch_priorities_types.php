<?php
include_once('connect.php'); // Include your database connection

$response = [];

try {
    // Fetch priorities from the database
    $stmt = $con->prepare("SELECT `id`, `title` FROM `priorities`");
    $stmt->execute();
    $priorities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return JSON response
    echo json_encode($priorities);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>