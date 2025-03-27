<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav>
    <ul class="back">
        <li><img src="logo.png" alt=""></li>
        <li><a href="home.php">Home</a></li>
        <?php if (isset($_SESSION['loggedin'])): ?>
            <li><a href="user_dashboard.php">Dashboard</a></li>
        <?php endif; ?>
        <li><a href="need_blood.php">Need Blood</a></li>
        <li><a href="donate_blood.php">Donate Blood</a></li>
        <li><a href="it's_an_emergency.php">It's An Emergency</a></li>
        <li><a href="why_donate_blood.php">Why Donate Blood</a></li>
        <li><a href="about_us.php">About Us</a></li>
        <li><a href="contactus.php">Contact Us</a></li>
        

        <?php if (!isset($_SESSION['loggedin'])): ?>
            <li><a href="registration.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
        <?php else: ?>
            <li><a href="logout.php">Logout</a></li>
        <?php endif; ?>

    </ul>
</nav>
