<?php
// Sample YouTube video URL (Replace with dynamic fetching if needed)
$videoId = "dQw4w9WgXcQ"; // Example video ID
$youtubeEmbedUrl = "https://www.youtube.com/watch?v=EpvHP0gWNlA" . $videoId;

echo json_encode(["url" => $youtubeEmbedUrl]);
?>