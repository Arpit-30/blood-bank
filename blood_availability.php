<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'blood_donation');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch blood stock based on blood group if form is submitted
$blood_group = "";
$stock = null;

if (isset($_POST['search'])) {
    $blood_group = $_POST['blood_group'];

    // Query to fetch the stock for the selected blood group
    $sql = "SELECT quantity FROM blood_stock WHERE blood_group='$blood_group'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stock = $row['quantity'];
    } else {
        $stock = "Blood group not available.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Availability</title>
    <link rel="stylesheet" href="admin_dashboard.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #2d2f3e;
            padding: 20px;
            color: white;
        }

        .sidebar h2 {
            color: #e74c3c;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
        }

        form {
            margin: 20px 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        select, input[type="text"] {
            margin-bottom: 10px;
            padding: 8px;
            width: 100%;
            max-width: 300px;
            box-sizing: border-box;
        }

        button {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .result {
            margin-top: 20px;
        }

        .result p {
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Sidebar -->
    
        <?php include("userheader.php") ?>
    
    <!-- Main Content -->
    <div class="main-content">
        <h2>Check Blood Availability</h2>
        <form action="blood_availability.php" method="post">
            <label for="blood_group">Select Blood Group:</label>
            <select name="blood_group" id="blood_group" required>
                <option value="">--Select Blood Group--</option>
                <option value="A+ve">A+ve</option>
                <option value="A-ve">A-ve</option>
                <option value="B+ve">B+ve</option>
                <option value="B-ve">B-ve</option>
                <option value="AB+ve">AB+ve</option>
                <option value="AB-ve">AB-ve</option>
                <option value="O+ve">O+ve</option>
                <option value="O-ve">O-ve</option>
            </select>
            <button type="submit" name="search">Check Availability</button>
        </form>
        <div class="result">
            <?php if ($stock !== null): ?>
                <p>Available stock for <?php echo htmlspecialchars($blood_group); ?>: 
                <?php echo htmlspecialchars($stock); ?> units.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>