<?php
header("Content-Type: application/json");

// Include database connection
require_once "connection.php";

$current_date = date("Y-m-d");

// Fetch past 3 programs (ordered by most recent first)
$sql_past = "SELECT `id`, `program_img`, `program_head`, `prog_location`, `prog_date`, `prog_discription`, `date_added`
             FROM `tbl_program`
             WHERE `prog_date` < '$current_date' AND `prog_date` IS NOT NULL
             ORDER BY `prog_date` DESC
             LIMIT 1";
$result_past = $conn->query($sql_past);
$past_programs = [];

while ($row = $result_past->fetch_assoc()) {
    // Ensure prog_date is valid
    if (!empty($row['prog_date']) && strtotime($row['prog_date']) !== false) {
        $prog_timestamp = strtotime($row['prog_date']);
        $current_timestamp = strtotime($current_date);
        $days_ago = max(0, round(($current_timestamp - $prog_timestamp) / (60 * 60 * 24))); // Prevent negative values
        $row['days'] = $days_ago . " Days Ago";
    } else {
        $row['days'] = "Unknown Date";
    }

    // Limit title length
    $row['program_head'] = mb_strimwidth($row['program_head'], 0, 50, "...");

    // Format program detail URL
    $row['program_detail_url'] = "/ngo_web/project-detail?id=" . $row['id'];

    $past_programs[] = $row;
}

// Fetch upcoming 3 programs (ordered by soonest first)
$sql_upcoming = "SELECT `id`, `program_img`, `program_head`, `prog_location`, `prog_date`, `prog_discription`, `date_added`
                 FROM `tbl_program`
                 WHERE `prog_date` >= '$current_date' AND `prog_date` IS NOT NULL
                 ORDER BY `prog_date` ASC
                 LIMIT 2";
$result_upcoming = $conn->query($sql_upcoming);
$upcoming_programs = [];

while ($row = $result_upcoming->fetch_assoc()) {
    // Ensure prog_date is valid
    if (!empty($row['prog_date']) && strtotime($row['prog_date']) !== false) {
        $prog_timestamp = strtotime($row['prog_date']);
        $current_timestamp = strtotime($current_date);
        $days_remaining = max(0, round(($prog_timestamp - $current_timestamp) / (60 * 60 * 24))); // Prevent negative values
        $row['days'] = $days_remaining . " Days Remaining";
    } else {
        $row['days'] = "Unknown Date";
    }

    // Limit title length
    $row['program_head'] = mb_strimwidth($row['program_head'], 0, 50, "...");

    // Format program detail URL
    $row['program_detail_url'] = "/ngo_web/project-detail?id=" . $row['id'];

    $upcoming_programs[] = $row;
}

// Merge and shuffle programs
$programs = array_merge($past_programs, $upcoming_programs);
shuffle($programs);

// Return JSON response
echo json_encode($programs);

$conn->close();
?>