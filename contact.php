<?php

include "db.php";

if (isset($_POST['send_message'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_messages
            (name, email, phone, subject, message)
            VALUES
            ('$name', '$email', '$phone', '$subject', '$message')";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Your message has been sent successfully!');
                window.location.href='contact.php';
              </script>";

    } else {

        echo "Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<title>Contact | PawConnect</title>
<link rel="stylesheet" href="contact.css">
</head>

<body>

<!-- ================= NAVBAR ================= -->
<div class="nav">
    <div class="logo">
        <img src="logo.jpeg" alt="PawConnect Logo">
        <h2>PawConnect</h2>
    </div>

    <div class="menu">
        <a href="home.html">HOME</a>
        <a href="animals.html">ANIMALS</a>

        <div class="dropdown">

    <a href="#">
        EXPLORE <i class="fa-solid fa-chevron-down"></i>
    </a>

    <div class="dropdown-content">

        <!-- ABOUT -->

        <div class="column">

            <h3>About</h3>

            <a href="about.html">About Us</a>

            <a href="mission.html">Mission</a>

            <a href="contact.html">Contact</a>

        </div>


        <!-- ADOPTION -->

        <div class="column">

            <h3>Adoption</h3>

            <a href="animals.html">Available Animals</a>

            <a href="care.html">Care After Adoption</a>

            <a href="stories.html">Adoption Stories</a>

        </div>


        <!-- NGO -->

        <div class="column">

            <h3>NGO</h3>

            <a href="ngo_login.php">NGO Login</a>

            <a href="dashboard.html">Dashboard</a>

            <a href="addanimal.html">Add Animal</a>

        </div>

    </div>

</div>

<a href="adopt.html">ADOPT</a>

<a href="contact.html">CONTACT</a>
    </div>

    <a href="login.php" class="login-btn">LOGIN</a>
</div>

<!-- ================= HERO ================= -->

<section class="contact-hero">

<div class="left">

<span class="small-title">
🐾 GET IN TOUCH
</span>

<h1>
We'd Love <br>
to Hear From <span>You!</span>
</h1>

<p>

Have a question, suggestion or want to adopt a rescued pet?
Our team is always ready to help you.

</p>

<div class="info-box">

<div class="box">

<i class="fa-solid fa-phone"></i>

<div>

<h3>Call Us</h3>

<p>+91 9876543210</p>

</div>

</div>

<div class="box">

<i class="fa-solid fa-envelope"></i>

<div>

<h3>Email</h3>

<p>support@pawconnect.com</p>

</div>

</div>

<div class="box">

<i class="fa-solid fa-location-dot"></i>

<div>

<h3>Visit Us</h3>

<p>Pune, Maharashtra</p>

</div>

</div>

<div class="box">

<i class="fa-solid fa-clock"></i>

<div>

<h3>Working Hours</h3>

<p>Mon - Sat | 9 AM - 7 PM</p>

</div>

</div>

</div>

</div>

<!-- ================= RIGHT SIDE ================= -->

<div class="right">

<div class="form-card">

<h2>
<i class="fa-regular fa-message"></i>
Send Us A Message
</h2>

<form method="POST" action="">

<div class="row">

<input type="text" name="name" placeholder="Your Name">

<input type="email" name="email" placeholder="Your Email">

</div>

<input type="text"  name="phone" placeholder="Phone Number">

<input type="text" name="subject" placeholder="Subject">

<textarea name="message" placeholder="Write Your Message"></textarea>

<button type="submit" name="send message">
<i class="fa-regular fa-paper-plane"></i>
SEND MESSAGE
</button>
</form>

</div>
</div>
</section>

<!-- =====================================================
     FOOTER
===================================================== -->

<footer class="footer">

    <div class="footer-top">


        <!-- PAWCONNECT BRAND -->

        <div class="footer-about">

            <div class="footer-logo">

                <img src="logo.jpeg"
                     alt="PawConnect Logo">

                <h2>
                    PawConnect
                </h2>

            </div>


            <p>
                Connecting rescued animals with loving families,
                trusted shelters and compassionate hearts across India.
            </p>


            <div class="social-icons">

                <a href="#" aria-label="Facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>

                <a href="#" aria-label="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>

                <a href="#" aria-label="X">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>

                <a href="#" aria-label="LinkedIn">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>

            </div>

        </div>



        <!-- EXPLORE -->

        <div class="footer-links">

            <h3>
                Explore
            </h3>

            <a href="home.html">
                Home
            </a>

            <a href="animals.html">
                Available Animals
            </a>

            <a href="adopt.html">
                Adoption
            </a>

            <a href="stories.html">
                Adoption Stories
            </a>

        </div>



        <!-- SERVICES -->

        <div class="footer-links">

            <h3>
                Services
            </h3>

            <a href="care.html">
                Care After Adoption
            </a>

            <a href="petcare.html">
                Pet Care
            </a>

            <a href="ngo-partners.html">
                NGO Partners
            </a>

            <a href="mission.html">
                Our Mission
            </a>

        </div>



        <!-- CONTACT -->

        <div class="footer-contact">

            <h3>
                Contact
            </h3>

            <p>
                <i class="fa-solid fa-location-dot"></i>
                Pune, Maharashtra
            </p>

            <p>
                <i class="fa-solid fa-phone"></i>
                +91 98765 43210
            </p>

            <p>
                <i class="fa-solid fa-envelope"></i>
                hello@pawconnect.in
            </p>

        </div>


    </div>



    <!-- FOOTER BOTTOM -->

    <div class="footer-bottom">

        <p>
            © 2026 PawConnect • Connecting every paw with care,
            compassion & a place to belong.
        </p>

    </div>


</footer>
</body>
</html>