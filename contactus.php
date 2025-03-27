
<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contactus.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
</head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

    <?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        // Database connection
        require 'dbcon.php'; // Adjust this to your connection file
        $sql = "INSERT INTO contactus (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

        if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Thank you for contacting us. We will get back to you soon!);</script>";
        } else {
        echo "<script>alert('Error:');</script> " . mysqli_error($conn) . "</p>";
        }


        mysqli_close($conn);
    }
    ?>
    <?php 
    include("header.php")
    ?>
    <div class="contact-container">
        <h1>Contact Us</h1>
        <p>If you have any questions or need further information, please feel free to contact us by filling out the form below:</p>

        <form action="contactus.php" method="post" class="contact-form">
            <label for="name">Your Name:</label>
            <input type="text" name="name" placeholder="Enter your name" required>

            <label for="email">Your Email:</label>
            <input type="email" name="email" placeholder="Enter your email" required>

            <label for="phone">Your Phone Number:</label>
            <input type="text" name="phone" placeholder="Enter your phone number" required>

            <label for="message">Your Message:</label>
            <textarea name="message" rows="5" placeholder="Enter your message" required></textarea>

            <input type="submit" value="Send Message">
        </form>
    </div>
    <?php 
    include("footer.php")
    ?>
</body>
</html>
