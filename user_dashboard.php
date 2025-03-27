<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <div class="container">
        <?php 
        include("userheader.php")
        ?>

        <div class="main-content">
            <header>
            <h1>Welcome</h1>

                <p>Manage your donations and blood requests from here.</p>
            </header>

            <section>
                <div class="stats">
                    <div class="card">
                        <h3>Your Blood Group</h3>
                        <p>
                            <?php
                            require 'dbcon.php';
                            $email = $_SESSION['email'];
                            $userQuery = "SELECT bloodgroup FROM user WHERE email = '$email'";
                            $result = mysqli_query($conn, $userQuery);

                            // Check if the query was successful
                            if ($result) {
                                $data = mysqli_fetch_assoc($result);
                                echo $data['bloodgroup'];
                            } else {
                                echo "Error fetching data.";
                            }
                            ?>
                        </p>
                    </div>

                    
                    <div class="card">
                        <h3>Pending Blood Requests</h3>
                        <p>
                            <?php
                            $requestQuery = "SELECT COUNT(*) as quantity FROM need_blood WHERE email = '$email' AND status = 'pending'";
                            $result = mysqli_query($conn, $requestQuery);

                            // Check if the query was successful
                            if ($result) {
                                $data = mysqli_fetch_assoc($result);
                                echo $data['quantity'];
                            } else {
                                echo "Error fetching data.";
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </section>

            <section class="tables">
                <h2>Your Recent Blood Requests</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Blood Group</th>
                            <th>Quantity (in units)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM need_blood WHERE email = '$email' ORDER BY id DESC LIMIT 5";
                        $result = mysqli_query($conn, $query);

                        // Check if the query was successful
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['blood_type'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Error fetching data.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>
</html>
