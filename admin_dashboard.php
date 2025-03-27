<!-- admin_dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <div class="container">
       <?php 
       include("adminheader.php")
       ?>

        <div class="main-content">
            <header>
                <h1>Welcome, Admin!</h1>
                <p>Manage the blood donation system from here.</p>
            </header>

            <section>
                <div class="stats">
                    <div class="card">
                        <h3>Total Users</h3>
                        <p>
                            <?php
                                require 'dbcon.php';
                                $userCountQuery = "SELECT COUNT(*) as total_users FROM user";
                                $result = mysqli_query($conn, $userCountQuery);
                                $data = mysqli_fetch_assoc($result);
                                echo $data['total_users'];
                            ?>
                        </p>
                    </div>
                    <?php 
                    // Database connection
                        require 'dbcon.php';

                        // Update request status if the admin changes it
                        if (isset($_POST['update_status'])) {
                            $request_id = $_POST['request_id'];
                            $new_status = $_POST['status'];

                            $updateQuery = "UPDATE need_blood SET status='$new_status' WHERE id='$request_id'";
                            mysqli_query($conn, $updateQuery);
                        }
                    ?>
                    <div class="card">
                        <h3>Total Donors</h3>
                        <p>
                            <?php
                                $donorCountQuery = "SELECT COUNT(*) as total_donors FROM donate_blood";
                                $result = mysqli_query($conn, $donorCountQuery);
                                $data = mysqli_fetch_assoc($result);
                                echo $data['total_donors'];
                            ?>
                        </p>
                    </div>

                    <div class="card">
                        <h3>Available Blood Units</h3>
                        <p>
                            <?php
                                $bloodCountQuery = "SELECT SUM(quantity) as total_units FROM blood_stock";
                                $result = mysqli_query($conn, $bloodCountQuery);
                                $data = mysqli_fetch_assoc($result);
                                echo $data['total_units'];
                            ?>
                        </p>
                    </div>

                    <div class="card">
                        <h3>Blood Requests</h3>
                        <p>
                            <?php
                                $requestCountQuery = "SELECT COUNT(*) as total_requests FROM blood_requests";
                                $result = mysqli_query($conn, $requestCountQuery);
                                $data = mysqli_fetch_assoc($result);
                                echo $data['total_requests'];
                            ?>
                        </p>
                    </div>
                </div>
            </section>

            
            
        </div>
    </div>
    
</body>
</html>
