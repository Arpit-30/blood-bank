<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_donation";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for fulfilled requests
$notify_sql = "SELECT hospital_name FROM blood_requests WHERE status = 'fulfilled' ORDER BY id DESC LIMIT 1";
$notify_result = $conn->query($notify_sql);

if ($notify_result->num_rows > 0) {
    $row = $notify_result->fetch_assoc();
    echo "data: Your blood request has been fulfilled! Pick up from: " . $row['hospital_name'] . "\n\n";
    flush();
}

$conn->close();
?>
