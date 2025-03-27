<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="header.css">
</head>
<body>
    
    <?php
            session_start();
            require 'dbcon.php'; // Database connection

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $_POST['email'];
                $password = $_POST['password'];

                // First, check if the user is an admin
                $adminCheck = "SELECT * FROM `admin` WHERE `email` = '$email' AND `password` = '$password'";
                $adminResult = mysqli_query($conn, $adminCheck);

                if (mysqli_num_rows($adminResult) > 0) {
                    // Admin login successful
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;

                    // Redirect to admin dashboard
                    header("Location: admin_dashboard.php");
                    exit();
                }

                // If not admin, check for user
                $userCheck = "SELECT * FROM `user` WHERE `email` = '$email' AND `passwords` = '$password'";
                $userResult = mysqli_query($conn, $userCheck);

                if (mysqli_num_rows($userResult) > 0) {
                    // User login successful
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;

                    // Redirect to user dashboard
                    header("Location:home.php");
                    exit();
                }
                $adminCheck = "SELECT * FROM `hospital` WHERE `email` = '$email' AND `password` = '$password'";
                $adminResult = mysqli_query($conn, $adminCheck);

                if (mysqli_num_rows($adminResult) > 0) {
                    // Admin login successful
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;

                    // Redirect to admin dashboard
                    header("Location: hospital_dashboard.php");
                    exit();
                
                } else {
                    // If neither admin nor user, show error
                    echo "<script>alert('Invalid email or password. Please try again');</script>";
                }
            }
        ?>
    <form action="" method="post">
    <?php include("header.php"); ?>
    
    <h1>Login</h1>
    
    <label for="email">Email:</label><br>
    <input type="text" name="email" placeholder="Email" class="tb1"> <br><br>

    <label for="password">Password:</label><br>
    <input type="password" name="password" placeholder="Password" class="tb1"><br><br>

    <input type="submit" value="login" class="btn">

    <!-- Registration Link -->
    <p>Don't have an account? <a href="registration.php">Register here</a></p>
</form>


</body>
</html>