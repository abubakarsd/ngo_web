<?php
header("Content-Type: application/json");

// Sample YouTube video ID (Replace with a dynamic one if needed)
$videoId = "sWUd-zemjLU?si=TSbaepN6qDUxhWxO"; // Example video ID

// Correct YouTube embed URL
$youtubeEmbedUrl = "https://www.youtube.com/embed/" . $videoId;

echo json_encode(["url" => $youtubeEmbedUrl]);
?>