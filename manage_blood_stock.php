<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}

require 'dbcon.php';

// Handle adding new blood stock entry
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $bloodGroup = $_POST['blood_group'];
    $quantity = $_POST['quantity'];

    // Insert new blood stock
    $insertQuery = "INSERT INTO blood_stock (blood_group, quantity) VALUES ('$bloodGroup', '$quantity')";
    if (mysqli_query($conn, $insertQuery)) {
        echo "<script>alert('New blood stock added!');</script>";
    } else {
        echo "<script>alert('Error:');</script> " . mysqli_error($conn);
    }
}

// Handle updating blood stock entry
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $stockId = $_POST['stock_id'];
    $bloodGroup = $_POST['blood_group'];
    $quantity = $_POST['quantity'];

    // Update blood stock
    $updateQuery = "UPDATE blood_stock SET blood_group='$bloodGroup', quantity='$quantity' WHERE id='$stockId'";
    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Blood stock updated!');</script>";
    } else {
        echo "<script>alert('Error:');</script> " . mysqli_error($conn);
    }
}

// Handle deleting blood stock entry
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $stockId = $_POST['delete_id'];
    $deleteQuery = "DELETE FROM blood_stock WHERE id='$stockId'";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "Blood stock deleted!');</script>";
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
    <title>Manage Blood Stock</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <div class="container">
       <?php 
        include("adminheader.php")
       ?>
        <div class="main-content">
            <header>
                <h1>Manage Blood Stock</h1>
            </header>

            <section>
                <h2>Add Blood Stock</h2>
                <form method="POST" class="add-stock-form">
                    <label for="blood_group">Blood Group:</label>
                    <select name="blood_group" required>
                        <option value="A+ve">A+ve</option>
                        <option value="B+ve">B+ve</option>
                        <option value="O+ve">O+ve</option>
                        <option value="AB+ve">AB+ve</option>
                        <option value="A-ve">A-ve</option>
                        <option value="B-ve">B-ve</option>
                        <option value="O-ve">O-ve</option>
                        <option value="AB-ve">AB-ve</option>
                    </select>
                    
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" required>
                    
                    <button type="submit" name="add">Add Stock</button>
                </form>
            </section>

            <section>
    <h2>Current Blood Stock</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Blood Group</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query to fetch current blood stock
            $query = "SELECT * FROM blood_stock";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['blood_group'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='stock_id' value='" . $row['id'] . "'>
                            <input type='text' name='blood_group' value='" . $row['blood_group'] . "' required>
                            <input type='number' name='quantity' value='" . $row['quantity'] . "' required>
                            <button type='submit' name='update'>Update</button>
                        </form>

                        <form method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure you want to delete this stock?\");'>
                            <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                            <button type='submit' name='delete'>Delete</button>
                        </form>
                      </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No blood stock available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>

        </div>
    </div>
    
</body>
</html>
