<?php
// Start session
session_start();

// Dummy data for hospital dashboard
$hospital_name = "City Hospital";
$pending_requests = 3;
$recent_requests = [
    ["id" => 10, "blood_group" => "B+", "quantity" => 2, "status" => "Pending"],
    ["id" => 9, "blood_group" => "A-", "quantity" => 3, "status" => "Fulfilled"],
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Dashboard</title>
    <link rel="stylesheet" href="hospital_dashboard.css">
</head>
<body>

<div class="sidebar">
    <h2>Hospital Dashboard</h2>
    <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Manage Requests</a></li>
        <li><a href="#">Blood Inventory</a></li>
        <li><a href="#">Notifications</a></li>
        <li><a href="#">Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <h1>Welcome, <?php echo $hospital_name; ?></h1>
    <p>Manage blood requests and inventory from here.</p>

    <div class="info-boxes">
        <div class="info-box">
            <h3>Hospital Name</h3>
            <p><?php echo $hospital_name; ?></p>
        </div>
        <div class="info-box">
            <h3>Pending Blood Requests</h3>
            <p><?php echo $pending_requests; ?></p>
        </div>
    </div>

    <h2>Your Recent Blood Requests</h2>
    <table>
        <tr>
            <th>Request ID</th>
            <th>Blood Group</th>
            <th>Quantity (in units)</th>
            <th>Status</th>
        </tr>
        <?php foreach ($recent_requests as $request) : ?>
            <tr>
                <td><?php echo $request['id']; ?></td>
                <td><?php echo $request['blood_group']; ?></td>
                <td><?php echo $request['quantity']; ?></td>
                <td><?php echo $request['status']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
