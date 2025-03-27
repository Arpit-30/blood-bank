<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_bank";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE notifications SET is_read = 1 WHERE is_read = 0";
$conn->query($sql);

echo json_encode(['status' => 'success']);

$conn->close();
?>
