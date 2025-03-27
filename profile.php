<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}

require 'dbcon.php'; // Database connection file

// Fetch user details
$email = $_SESSION['email'];
$userQuery = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($conn, $userQuery);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);  // Fetch the user data
} else {
    // Handle case where no user data is found
    die("Error fetching data or user not found.");
}

// Update Profile
// Update Profile
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    // Validate form inputs
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $phonenumber = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '';
    $bloodgroup = isset($_POST['bloodgroup']) ? $_POST['bloodgroup'] : '';

    if (!empty($firstname) && !empty($phonenumber) && !empty($bloodgroup)) {
        // Update user profile
        $updateQuery = "UPDATE user SET firstname='$firstname', phonenumber='$phonenumber', bloodgroup='$bloodgroup' WHERE email='$email'";
        if (mysqli_query($conn, $updateQuery)) {
            echo "<script>alert('Profile updated successfully.');</script>";
            $_SESSION['firstname'] = $firstname; // Update session name
        } else {
            echo "<script>alert('Error updating profile. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all the fields.');</script>";
    }
}


// Delete Profile
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $deleteQuery = "DELETE FROM user WHERE email='$email'";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>alert('Profile deleted successfully.');</script>";
        session_destroy();
        header("location: registration.php");
        exit;
    } else {
        echo "<scrpit>alert('Error deleting profile.');</scrpit>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <?php 
    include("userheader.php")
    ?>

    <div class="main-content">
        <h2>Update Profile</h2>
        <div class="form-container">
            <form action="profile.php" method="post">
                <label for="name">Name:</label>
                <input type="text" name="firstname"  required>

                <label for="phone">Phone:</label>
                <input type="text" name="phonenumber"  required>

                <label for="bloodgroup">Blood Group:</label>
                <input type="text" name="bloodgroup"  required>

                <button type="submit" name="update">Update Profile</button>
            </form>
        </div>

        <h2>Delete Profile</h2>
        <form action="profile.php" method="post">
            <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete your profile?');">Delete Profile</button>
        </form>
    </div>
</body>
</html>
