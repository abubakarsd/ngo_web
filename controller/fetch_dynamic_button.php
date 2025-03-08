<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('connection.php'); // Ensure the correct path to your connection file

header('Content-Type: application/json'); // Set JSON response header

try {
    $sql = "SELECT btn_text, btn_style, txt_external, txt_internal FROM tbl_dynamic_button LIMIT 1";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo json_encode(["error" => "SQL prepare error: " . $conn->error]);
        exit;
    }

    $stmt->execute();
    $stmt->bind_result($btn_text, $btn_style, $txt_external, $txt_internal);

    if ($stmt->fetch()) {
        echo json_encode([
            "btn_text" => $btn_text,
            "btn_style" => $btn_style,
            "txt_external" => $txt_external,
            "txt_internal" => $txt_internal
        ]);
    } else {
        echo json_encode(["error" => "No data found"]);
    }

    $stmt->close();
} catch (Exception $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}
?>