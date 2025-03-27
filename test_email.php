<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure PHPMailer is installed via Composer

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 3; // Set to 3 for detailed debug output
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'bloodbank3001@gmail.com'; 
    $mail->Password   = 'mouw rnmq dton qwrc'; // Use App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;


    $mail->setFrom('bloodbank3001@gmail.com', 'Blood Bank');
    $mail->addAddress('yugnayak188@gmail.com', 'Test User');

    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = '<h3>This is a test email from your PHP script.</h3>';

    if ($mail->send()) {
        echo "✅ Test email sent successfully!";
    } else {
        echo "❌ Email not sent: " . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "❌ PHPMailer Error: " . $mail->ErrorInfo;
}
?>
