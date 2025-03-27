<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<?php
// Connect to the database
$host = "localhost";
$user = "root";  // Change as per your database configuration
$pass = "";      // Change as per your database configuration
$db = "blood_donation";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $blood_type = $_POST['blood_type'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    // Insert data into the database
    $sql = "INSERT INTO donate_blood (name, email, blood_type, phone, age, gender) VALUES ('$name', '$email', '$blood_type', '$phone', '$age', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thank you for registering as a donor!');</script>";
    } else {
        echo "<script>alert('Error:');</script? " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation</title>
    <link rel="stylesheet" href="donate_blood.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    
</head>
<body>
<?php 
    include("header.php")
?>
<div class="donation-form">
    <h1>Donate Blood, Save Lives</h1>
    <form method="POST" action="">
       
        
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"  required>

        

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone"  required>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required min="18" max="65" >
        <label for="blood_type">Blood Type:</label>
        <select id="blood_type" name="blood_type" class="tb" required>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
        </select>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" class="tb" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br>

        <input type="submit"  class="tb" value="Donate Now">
    </form>
</div>
<?php 
include("footer.php")
?>
</body>
</html>
