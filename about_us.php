<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Blood Donation</title>
    <link rel="stylesheet" href="about_us.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
</head>
<body>
    <?php
    include("header.php")
    ?>

    <section class="about-us-section">
        <div class="container">
            <h2>About Us</h2>
            <p>Welcome to Blood Donation, a platform dedicated to connecting blood donors with those in need. Our mission is to make the process of blood donation simple, accessible, and impactful. We believe that every drop of blood can make a difference in someone's life.</p>

            <h3>Our Mission</h3>
            <p>Our mission is to create a bridge between blood donors and recipients, ensuring that no one in need of blood goes without it. We aim to create awareness about the importance of blood donation and provide an easy platform for individuals to register as donors or request blood.</p>

            <h3>Our Vision</h3>
            <p>We envision a world where every individual in need of a blood transfusion has access to safe and sufficient blood supply. Our goal is to create a self-sustaining blood donation community through continuous engagement and support.</p>

            <h3>What We Do</h3>
            <ul>
                <li>Organize regular blood donation drives in collaboration with hospitals and community centers.</li>
                <li>Provide an easy-to-use platform for potential donors and recipients to connect.</li>
                <li>Raise awareness about the need for regular blood donations through educational programs.</li>
                <li>Ensure that blood donation is safe and accessible to everyone, while maintaining high standards of health and safety.</li>
            </ul>
        </div>
    </section>

    <!-- <section class="team-section">
        <div class="container">
            <h2>Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="team-member1.jpg" alt="Team Member 1">
                    <h3>John Doe</h3>
                    <p>Founder & CEO</p>
                </div>
                <div class="team-member">
                    <img src="team-member2.jpg" alt="Team Member 2">
                    <h3>Jane Smith</h3>
                    <p>Chief Operating Officer</p>
                </div>
                <div class="team-member">
                    <img src="team-member3.jpg" alt="Team Member 3">
                    <h3>Emily Johnson</h3>
                    <p>Head of Community Outreach</p>
                </div>
            </div>
        </div>
    </section> -->

    <section class="history-section">
        <div class="container">
            <h2>Our History</h2>
            <p>Founded in 2022, Blood Donation started as a small community project aimed at addressing the shortage of blood during emergencies. Over the years, we have grown into a nationwide platform, thanks to our dedicated team and the thousands of donors who have joined our mission. From organizing local blood drives to establishing an online platform, we have made significant strides in ensuring that blood donation becomes a regular part of people's lives.</p>
        </div>
    </section>

    <?php 
    include("footer.php")
    ?>
</body>
</html>
