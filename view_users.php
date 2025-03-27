<?php
// Start the session and include database connection
require 'dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <?php 
        include("adminheader.php")
        ?>

        <div class="main-content">
            <header>
                <h1>Manage Users</h1>
            </header>
            
            <section class="tables">
                <table>
                    <thead>
                        <tr>
                            
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Blood Group</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query to fetch users from the database
                        $query = "SELECT * FROM user";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            // Loop through the users and display them in the table
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                // Check if the 'id' index exists in the row
                               
                                echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['phonenumber'] . "</td>";
                                
                                echo "<td>" . $row['bloodgroup'] . "</td>";
                                
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No users found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>
</html>
