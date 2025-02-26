<?php
// Start session (if needed)
session_start();

// Get requested page from the URL
$page = isset($_GET['page']) ? $_GET['page'] : 'index';
$file = "page/$page.php";

// Check if the file exists, else show a 404 error
if (file_exists($file)) {
    include "controller/functions.php";  // Load common functions
    include "controller/header.php";  // Load header from controller folder
    include $file;  // Load requested page
    include "controller/footer.php";  // Load footer
} else {
    include "controller/header.php";  // Show header even for 404
    include "page/404.php";  // Show 404 error page
    include "controller/footer.php";  // Show footer
}
?>