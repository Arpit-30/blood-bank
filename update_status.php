<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure PHPMailer is installed via Composer
require 'dbcon.php'; // Include database connection

// Function to send email notifications
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
        $mail->Subject = 'Blood Request Status Update';

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
    $table_name = $_POST['table_name']; // 'need_blood' or 'its_an_emergency'

    // Fetch user details from the correct table
    $query = "SELECT name, email, blood_type FROM $table_name WHERE id = '$request_id'";
    $result = mysqli_query($conn, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $recipientEmail = $row['email'];
        $recipientName = $row['name'];
        $bloodType = $row['blood_type'];

        // Update the status in the database
        $update_query = "UPDATE $table_name SET status='$new_status' WHERE id='$request_id'";
        if (mysqli_query($conn, $update_query)) {
            
            // If the request is fulfilled, decrement blood stock
            if ($new_status == "Fulfilled") {
                
                // Check available stock before decrementing
                $stock_query = "SELECT quantity FROM blood_stock WHERE blood_group='$bloodType'";
                $stock_result = mysqli_query($conn, $stock_query);
                if ($stock_row = mysqli_fetch_assoc($stock_result)) {
                    $current_stock = $stock_row['quantity'];

                    if ($current_stock > 0) {
                        // Decrement stock
                        $decrement_query = "UPDATE blood_stock SET quantity = quantity - 1 WHERE blood_group='$bloodType'";
                        mysqli_query($conn, $decrement_query);

                        // Send email notification
                        $emailStatus = sendEmailNotification($recipientEmail, $recipientName, $bloodType, $new_status);
                        if ($emailStatus === true) {
                            echo "<script>alert('Status updated successfully! Stock updated. Email sent.'); window.location.href='dashboard.php';</script>";
                        } else {
                            echo "<script>alert('Status updated, stock updated, but email could not be sent: $emailStatus');</script>";
                        }
                    } else {
                        echo "<script>alert('Status updated, but stock is 0. Blood not available!');</script>";
                    }
                }
            } else {
                echo "<script>alert('Status updated successfully!'); window.location.href='dashboard.php';</script>";
            }
        } else {
            echo "<script>alert('Error updating status: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>
