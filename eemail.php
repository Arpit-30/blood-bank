<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure PHPMailer is installed via Composer
require 'dbcon.php'; // Include database connection

// Function to send email
function sendEmailNotification($recipientEmail, $recipientName, $bloodType, $status) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bloodbank3001@gmail.com'; 
        $mail->Password   = 'mouw rnmq dton qwrc'; // Use App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Email Recipients
        $mail->setFrom('bloodbank3001@gmail.com', 'Blood Bank');
        $mail->addAddress($recipientEmail, $recipientName);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'emergency Blood Request Status Update';

        if ($status == "Fulfilled") {
            $mail->Body = "
                <h2>Blood Request Approved</h2>
                <p>Dear <b>$recipientName</b>,</p>
                <p>Your request for blood type <b>$bloodType</b> has been <b>fulfilled</b>.</p>
                <p>Please visit the blood bank to collect it.</p>
                <br>
                <p>Regards,<br>Blood Bank Team</p>
            ";
        } else {
            $mail->Body = "
                <h2>Blood Request Update</h2>
                <p>Dear <b>$recipientName</b>,</p>
                <p>Your request for blood type <b>$bloodType</b> is currently in <b>Pending</b> status.</p>
                <br>
                <p>Regards,<br>Blood Bank Team</p>
            ";
        }

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Email error: {$mail->ErrorInfo}";
    }
}

// Handle status update request
if (isset($_POST['update_status'])) {
    $request_id = $_POST['request_id'];
    $new_status = $_POST['status'];

    // Fetch user details from database
    $query = "SELECT name, email, blood_type FROM emergency_requests WHERE id = '$request_id'";
    $result = mysqli_query($conn, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $recipientEmail = $row['email'];
        $recipientName = $row['name'];
        $bloodType = $row['blood_type'];

        // Update the status in the database
        $update_query = "UPDATE emergency_requests SET status='$new_status' WHERE id='$request_id'";
        if (mysqli_query($conn, $update_query)) {
            // Send email notification only if status is changed to "Fulfilled"
            if ($new_status == "Fulfilled") {
                $emailStatus = sendEmailNotification($recipientEmail, $recipientName, $bloodType, $new_status);
                if ($emailStatus === true) {
                    echo "<script>alert('Status updated successfully! Email sent.'); window.location.href='eemail.php';</script>";
                } else {
                    echo "<script>alert('Status updated, but email could not be sent: $emailStatus');</script>";
                }
            } else {
                echo "<script>alert('Status updated successfully!'); window.location.href='eemail.php';</script>";
            }
        } else {
            echo "<script>alert('Error updating status: " . mysqli_error($conn) . "');</script>";
        }
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
                        $query = "SELECT * FROM emergency_requests ORDER BY id DESC LIMIT 5";
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
