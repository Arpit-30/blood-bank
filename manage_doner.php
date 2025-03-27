<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}

require 'dbcon.php';

// Handle adding new donor
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $blood_type = $_POST['blood_type'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $contact = $_POST['phone'];
    $gender = $_POST['gender'];

    // Insert new donor into database
    $insertQuery = "INSERT INTO donate_blood (name, blood_type, email, age, phone, gender) 
    VALUES ('$name', '$blood_type', '$email', '$age', '$contact', '$gender')";
    
    if (mysqli_query($conn, $insertQuery)) {
        echo "<script>alert('New donor added!');</script>";
    } else {
        echo "<script>alert('Error:');</script> " . mysqli_error($conn);
    }
}

// Handle updating donor information
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $donorId = $_POST['donor_id'];
    $name = $_POST['name'];
    $blood_type = $_POST['blood_type'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $contact = $_POST['phone'];
    $gender = $_POST['gender'];

    // Update donor information in the database
    $updateQuery = "UPDATE donate_blood SET name='$name', blood_type='$blood_type', email='$email', age='$age', contact='$contact', gender='$gender' WHERE id='$donorId'";
    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Donor information updated!');</script>";
    } else {
        echo "<script>alert('Error:');</script> " . mysqli_error($conn);
    }
}

// Handle deleting donor
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $donorId = $_POST['delete_id'];
    $deleteQuery = "DELETE FROM donate_blood WHERE id='$donorId'";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>alert('Donor deleted!');</script>";
    } else {
        echo "<script>alert('Error:');</script> " . mysqli_error($conn);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Donors</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <div class="container">
        <?php 
        include("adminheader.php")
        ?>

        <div class="main-content">
            <header>
                <h1>Manage Donors</h1>
            </header>

            <section>
                <h2>Add New Donor</h2>
                <form method="POST" class="add-donor-form">
                    <label for="name">Name:</label>
                    <input type="text" name="name" required><br><br>
                    
                    <label for="blood_type">Blood Group:</label>
                        <select name="blood_type" required>
                        <option value="A+ve">A+ve</option>
                        <option value="B+ve">B+ve</option>
                        <option value="O+ve">O+ve</option>
                        <option value="AB+ve">AB+ve</option>
                        <option value="A-ve">A-ve</option>
                        <option value="B-ve">B-ve</option>
                        <option value="O-ve">O-ve</option>
                        <option value="AB-ve">AB-ve</option>
                    </select><br><br>
                    <label for="email">Email:</label>
                    <input type="email" name="email" required><br><br>

                    <label for="age">Age:</label>
                    <input type="number" name="age" min="18" max="50" required><br><br>

                    <label for="phone">Phone No:</label>
                    <input type="text" name="phone" required><br><br>
                    
                    <label for="Gender">Gender:</label>
                    <select name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>
                    </select><br><br>
                    
                    <button type="submit" name="add">Add Donor</button>
                </form>
            </section>

            <section>
                <h2>Current Donors</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Blood Group</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>phone</th>
                            <th>gender</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query to fetch current donors
                        $query = "SELECT * FROM donate_blood";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['blood_type'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['age'] . "</td>";
                                echo "<td>" . $row['phone'] . "</td>";
                                echo "<td>" . $row['gender'] . "</td>";
                                echo "<td>
                                <form method='POST' style='display:inline;'>
                                    <input type='hidden' name='donor_id' value='" . $row['id'] . "'>
                                    <input type='text' name='name' value='" . $row['name'] . "' required>
                                    <input type='text' name='blood_type' value='" . $row['blood_type'] . "' required>
                                    <input type='email' name='email' value='" . $row['email'] . "' required>
                                    <input type='number' name='age' value='" . $row['age'] . "' required>
                                    <input type='text' name='phone' value='" . $row['phone'] . "' required>
                                    <input type='text' name='gender' value='" . $row['gender'] . "' required>
                                    <button type='submit' name='update'>Update</button>
                                </form>

                                   <form method='POST' style='display:inline;'>
                            <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                            <button type='submit' name='delete'>Delete</button>
                        </form>
                                  </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No donors found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>

</body>
</html>
