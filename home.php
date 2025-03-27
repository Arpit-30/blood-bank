<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Blood Donation</title>
    <link rel="stylesheet" href="home.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <script>
document.getElementById('notification-badge').addEventListener('click', function() {
    fetch('mark_as_read.php')
        .then(response => response.json())
        .then(() => {
            document.getElementById('notification-badge').style.display = 'none';
            document.getElementById('notification-list').innerHTML = "";
        });
});
</script>
<script>
    const socket = new WebSocket("ws://localhost:8080");

    socket.onopen = function() {
        console.log("✅ WebSocket connection established!");
        socket.send("Hello Server!");
    };

    socket.onmessage = function(event) {
        console.log("📩 Message from server:", event.data);
    };

    socket.onerror = function(error) {
        console.error("❌ WebSocket Error:", error);
    };

    socket.onclose = function() {
        console.log("❌ WebSocket connection closed!");
    };
</script>

</head>
<body>
    <!-- Header Section -->
    <?php include("header.php"); ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h2>Donate Blood, Save Lives</h2>
            <p>Your blood can give someone another chance at life. Donate today and make a difference in someone's life.</p>

            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
                <a href="need_blood.php" class="btn">I Need Blood</a>
                <a href="donate_blood.php" class="btn">Become a Donor</a>
            <?php else : ?>
                <a href="login.php" class="btn">I Need Blood</a>
                <a href="login.php" class="btn">Become a Donor</a>
            <?php endif; ?>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works-section">
        <div class="container">
            <h2>How Blood Donation Works</h2>
            <div class="steps">
                <div class="step-item">
                    <h3>Step 1: Register</h3>
                    <p>Sign up as a donor or request blood for someone in need by registering on our platform.</p>
                </div>
                <div class="step-item">
                    <h3>Step 2: Get Matched</h3>
                    <p>We match eligible blood donors with those in need of blood based on location and blood type.</p>
                </div>
                <div class="step-item">
                    <h3>Step 3: Donate</h3>
                    <p>Once matched, donate blood at the nearest blood bank or hospital, and save a life.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Donate Section -->
    <section class="why-donate-section">
        <div class="container">
            <h2>Why Donate Blood?</h2>
            <p>Blood donation is a simple act of kindness that can make a profound difference in someone's life.</p>
            <ul>
                <li>Blood is essential for surgeries, accidents, and cancer treatment.</li>
                <li>One donation can save up to three lives.</li>
                <li>It helps maintain a healthy heart by reducing iron levels in the body.</li>
            </ul>
            <a href="whydonate.php" class="btn">Learn More</a>
        </div>
    </section>

    <!-- Blood Facts Section -->
    <section class="blood-facts-section">
        <div class="container">
            <h2>Did You Know?</h2>
            <div class="facts">
                <div class="fact-item">
                    <h3>Fact 1</h3>
                    <p>Someone needs blood every 2 seconds in the world.</p>
                </div>
                <div class="fact-item">
                    <h3>Fact 2</h3>
                    <p>One donation can save up to 3 lives.</p>
                </div>
                <div class="fact-item">
                    <h3>Fact 3</h3>
                    <p>Your body replaces the donated blood within 24 hours.</p>
                </div>
            </div>
        </div>
    </section>
    <script>
function playNotificationSound() {
    var audio = new Audio('notification.mp3'); // Ensure you have 'notification.mp3' in your project folder
    audio.play();
}

function fetchNotifications() {
    fetch('get_notifications.php')
        .then(response => response.json())
        .then(data => {
            let badge = document.getElementById('notification-badge');
            let notificationList = document.getElementById('notification-list');

            notificationList.innerHTML = ""; // Clear old notifications

            if (data.notifications.length > 0) {
                playNotificationSound(); // Play sound on new notification

                badge.style.display = 'block';
                badge.innerText = data.notifications.length;

                data.notifications.forEach(notification => {
                    let li = document.createElement('li');
                    li.innerText = `${notification.hospital_name}: ${notification.message}`;
                    notificationList.appendChild(li);
                });
            } else {
                badge.style.display = 'none';
            }
        })
        .catch(error => console.error('Error:', error));
}

// Check for new notifications every 5 seconds
setInterval(fetchNotifications, 5000);
</script>
<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/11.5.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.5.0/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyDhUHM_uKdVg5wWRL3lyhJQ-QsWl9iEfTM",
    authDomain: "blood-donation-a5a78.firebaseapp.com",
    projectId: "blood-donation-a5a78",
    storageBucket: "blood-donation-a5a78.firebasestorage.app",
    messagingSenderId: "372273748433",
    appId: "1:372273748433:web:4c423769fdce6831b0e8f0",
    measurementId: "G-SXR8QBQP1H"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script>e


    <!-- Footer Section -->
    <?php include("footer.php"); ?>
</body>
</html>
