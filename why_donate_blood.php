<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Why Donate Blood? | Blood Donation</title>
    <link rel="stylesheet" href="why_donate_blood.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
</head>
<body>
        
            
            <?php 
            include("header.php")
            ?>
    

    <section class="why-donate-section">
        <div class="container">
            <h2>Why Donate Blood?</h2>
            <p>Every second, someone in the world needs blood. Blood donation is a noble act that can save lives. Below are some reasons why donating blood is important:</p>
            
            <div class="reasons">
                <div class="reason-item">
                    <h3>1. Save Lives</h3>
                    <p>Blood transfusions are needed for surgeries, accidents, cancer treatment, and many chronic illnesses. Just one donation can save up to three lives!</p>
                </div>
                <div class="reason-item">
                    <h3>2. Maintain a Healthy Heart and Liver</h3>
                    <p>Regular blood donation helps to maintain iron levels in your blood, reducing the risk of heart disease and liver issues.</p>
                </div>
                <div class="reason-item">
                    <h3>3. Stimulate Blood Cell Production</h3>
                    <p>After donating blood, your body works to replenish the blood, which helps in stimulating new blood cell production, keeping you healthier.</p>
                </div>
                <div class="reason-item">
                    <h3>4. Get a Free Health Check-up</h3>
                    <p>Before donating blood, you undergo a mini check-up to ensure you’re healthy. This includes checking your hemoglobin level, blood pressure, pulse, and more.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="who-can-donate-section">
        <div class="container">
            <h2>Who Can Donate Blood?</h2>
            <ul>
                <li>Anyone aged between 18 and 65.</li>
                <li>Weighing more than 50 kg.</li>
                <li>Healthy individuals with no chronic or contagious diseases.</li>
                <li>No history of blood transfusion or recent major surgery.</li>
            </ul>
            <p>If you're eligible, consider donating today. Your contribution could make all the difference for someone in need!</p>
        </div>
    </section>

    <section class="donation-facts-section">
        <div class="container">
            <h2>Interesting Facts About Blood Donation</h2>
            <ul>
                <li>Only about 10% of eligible individuals donate blood regularly.</li>
                <li>Each blood donation can help save three or more lives.</li>
                <li>Your body replaces the lost fluids within 24 to 48 hours of donation.</li>
                <li>Donating blood reduces the risk of certain cancers.</li>
            </ul>
        </div>
    </section>

    <?php 
include("footer.php")
?>
</body>
</html>
