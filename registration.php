<?php
session_start();
require 'dbcon.php';

$alert = false;
$error = false;
$notnull = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $phone = mysqli_real_escape_string($conn, $_POST['phoneno']);
    $bgroup = mysqli_real_escape_string($conn, $_POST['bgroup']);
    $ldonation = mysqli_real_escape_string($conn, $_POST['ldonation']);

    // Check if email already exists
    $check_sql = "SELECT * FROM `user` WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        // Redirect with error message in URL
        header("Location: registration.php?error=email_exists");
        exit();
    } else {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $sql = "INSERT INTO `user` (`firstname`, `lastname`, `email`, `passwords`, `phonenumber`, `bloodgroup`, `last_donation`) 
                VALUES ('$fname', '$lname', '$email','$hashed_password', '$phone', '$bgroup', '$ldonation')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header("Location: login.php");
            exit();
        } else {
            $notnull = "Error in registration: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="registration.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('error') && urlParams.get('error') === 'email_exists') {
                alert("This email is already registered. Please use a different email.");
            }

            document.getElementById("submit").addEventListener("click", function(event) {
                const password = document.querySelector('input[name="password"]').value;
                const firstLetterUppercase = /^[A-Z]/.test(password);
                const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
                const hasNumber = /\d/.test(password);

                if (!firstLetterUppercase || !hasSpecialChar || !hasNumber) {
                    event.preventDefault();
                    let errorMessage = "Password must:\n";
                    if (!firstLetterUppercase) errorMessage += "- Start with an uppercase letter\n";
                    if (!hasSpecialChar) errorMessage += "- Contain at least one special character\n";
                    if (!hasNumber) errorMessage += "- Contain at least one number\n";
                    alert(errorMessage);
                }
            });
        });
    </script>
</head>
<body>
    <form action="registration.php" method="post">
        <?php include("header.php"); ?>
        <h1>Registration</h1>
        <div>
            <label>First Name:</label><br><input class="tb1" type="text" name="fname" placeholder="First name" required><br><br>
            <label>Last Name:</label><br><input class="tb1" type="text" name="lname" placeholder="Last name" required><br><br>
            <label>Email:</label><br><input class="tb1" type="email" name="email" placeholder="Email" required><br><br>
            <label>Password:</label><br><input class="tb1" type="password" name="password" placeholder="Password" required><br><br>
            <label>Last Donation:</label><br><input class="tb1" type="date" name="ldonation" required><br><br>
            <label>Phone Number:</label><br><input class="tb1" type="tel" maxlength="10" name="phoneno" placeholder="Phone Number" required><br><br>
            <label>Blood Group:</label><br>
            <select name="bgroup" class="sel">
                <option value="A+ve">A+ve</option>
                <option value="B+ve">B+ve</option>
                <option value="O+ve">O+ve</option>
                <option value="AB+ve">AB+ve</option>
                <option value="A-ve">A-ve</option>
                <option value="B-ve">B-ve</option>
                <option value="O-ve">O-ve</option>
                <option value="AB-ve">AB-ve</option>
            </select><br><br><br>
            <input type="submit" class="btn" name="submit" id="submit" value="Submit">
        </div>
    </form>

    <?php include("footer.php"); ?>
</body>
</html>
