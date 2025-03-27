<?php
// Start the session and include database connection
require 'dbcon.php';

// Handle status update request
if (isset($_POST['update_status'])) {
    $request_id = $_POST['request_id'];
    $new_status = $_POST['status'];

    // Update the status in the database
    $update_query = "UPDATE need_blood SET status='$new_status' WHERE id='$request_id'";
    
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Status updated successfully!'); window.location.href='email.php';</script>";
    } else {
        echo "<script>alert('Error updating status: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <?php include("adminheader.php"); ?>

        <div class="main-content">
            <header>
                <h1>Latest Need Blood Requests</h1>
            </header>

            <section class="tables">
                <table>
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Blood Group</th>
                            <th>Location</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $query = "SELECT * FROM need_blood ORDER BY id DESC LIMIT 5";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['blood_type'] . "</td>";
                            echo "<td>" . $row['location'] . "</td>";

                            // Status update form
                            echo "<td>";
                            echo "<form method='POST' action=''>";
                            echo "<input type='hidden' name='request_id' value='" . $row['id'] . "'>";
                            echo "<select name='status'>";
                            echo "<option value='Pending'" . ($row['status'] == 'Pending' ? ' selected' : '') . ">Pending</option>";
                            echo "<option value='Fulfilled'" . ($row['status'] == 'Fulfilled' ? ' selected' : '') . ">Fulfilled</option>";
                            echo "</select>";
                            echo "<button type='submit' name='update_status'>Update</button>";
                            echo "</form>";
                            echo "</td>";

                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>
</html>
