<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'blood_bank';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['request_id'])) {
    $request_id = intval($_POST['request_id']);
    $secret_code = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);

    $sql = "UPDATE blood_requests SET status='fulfilled', secret_code='$secret_code' WHERE id=$request_id";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "secret_code" => $secret_code]);
    } else {
        echo json_encode(["success" => false, "error" => $conn->error]);
    }
}

$conn->close();
?>
