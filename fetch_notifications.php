<?php

// Fetch the latest notifications where status is "fulfilled"
$sql = "SELECT * FROM need_blood WHERE request_status = 'accepted' ORDER BY updated_at DESC LIMIT 5";
$result = $conn->query($sql);

$notifications = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = [
            'id' => $row['id'],
            'message' => 'Your blood request has been accepted!',
            'hospital' => $row['hospital_name'],
            'status' => $row['request_status']
        ];
    }
}

// Return JSON response
echo json_encode($notifications);
$conn->close();
?>
