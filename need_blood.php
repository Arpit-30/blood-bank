

<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "blood_donation";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $blood_type = $_POST['blood_type'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $location = $_POST['location'];

    // Insert data into the database
    $sql = "INSERT INTO need_blood (name, blood_type, phone, email, location) 
            VALUES ('$name', '$blood_type', '$phone', '$email', '$location')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "<script>alert('Your blood request has been successfully submitted!');</script>";
    } else {
        $error_message = "<script>alert('Error:');</script> " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Need Blood? | Blood Donation</title>
    <link rel="stylesheet" href="need_blood.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
</head>
<body>
   <?php 
   include("header.php")
   ?>

    <section class="request-blood-section">
        <div class="container">
            <h2>Request Blood</h2>

            <?php if (isset($success_message)) { ?>
                <p class="success"><?php echo $success_message; ?></p>
            <?php } elseif (isset($error_message)) { ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php } ?>

            <form action="need_blood.php" method="POST">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="blood_type">Blood Type:</label>
                <select id="blood_type" name="blood_type" required>
                    <option value="">Select Blood Type</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>

                <label for="phone">Contact Number:</label>
                <input type="text" id="phone" name="phone" required>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>

                <label for="location">Location (City, State):</label>
                <input type="text" id="location" name="location" required>

                <button type="submit">Submit Request</button>
            </form>
        </div>
    </section>

    <?php 
include("footer.php")
?>
</body>
</html>
