<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include 'db_connection.php'; // Include your database connection file

if (isset($_POST['update'])) {  
    echo "✅ Update button clicked!<br>";  

    $request_id = $_POST['request_id'];
    $status = 'Fulfilled'; 

    // Run SQL update query
    $sql = "UPDATE need_blood SET status='$status' WHERE id='$request_id'";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Database updated successfully!<br>";  

        // Now send email after updating status
        echo "📨 Preparing to send email...<br>";

        require 'PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';  // Your Gmail
        $mail->Password = 'your-app-password';  // Your App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('your-email@gmail.com', 'Blood Bank');
        $mail->addAddress('recipient-email@example.com');  // Use actual email
        $mail->Subject = 'Blood Request Fulfilled';
        $mail->Body    = 'Your blood request has been fulfilled. Please collect your blood.';
        $mail->isHTML(true);

        echo "📤 Sending email...<br>";

        if (!$mail->send()) {
            echo "❌ Mailer Error: " . $mail->ErrorInfo . "<br>";  // Show error if email fails
        } else {
            echo "✅ Email sent successfully!<br>";
        }
    } else {
        echo "❌ Database update failed: " . $conn->error . "<br>";
    }
}
?>
