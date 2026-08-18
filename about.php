<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>About Us | PawConnect</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet"
          href="about.css">

</head>

<body>


<!-- =====================================================
     NAVBAR
===================================================== -->
 <div class="nav">

    <!-- LOGO -->
    <div class="logo">
        <img src="logo.jpeg" alt="PawConnect Logo">
        <h2>PawConnect</h2>
    </div>

    <!-- CENTER MENU -->
    <div class="menu">

        <a href="home.php">HOME</a>

        <a href="about.php">ABOUT US</a>

        <!-- EXPLORE -->
        <div class="dropdown">

            <a href="#">
                EXPLORE
                <i class="fa-solid fa-chevron-down"></i>
            </a>

            <div class="dropdown-content">

                <div class="column">
                    <h3>About</h3>

                    <a href="about.php">About Us</a>
                    <a href="mission.php">Mission</a>
                    <a href="contact.php">Contact</a>
                </div>

                <div class="column">
                    <h3>Adoption</h3>

                    <a href="animals.php">Available Animals</a>
                    <a href="care.php">Care After Adoption</a>
                    <a href="stories.php">Adoption Stories</a>
                </div>

                <div class="column">
                    <h3>Login</h3>

                    <a href="login.php">User Login</a>
                    <a href="ngo_login.php">NGO Login</a>
                    <a href="admin_login.php">Admin Login</a>
                </div>

            </div>

        </div>

        <a href="animals.php">ANIMALS</a>

        <a href="<?php
            echo isset($_SESSION['user_id'])
                ? 'user_dashboard.php'
                : 'login.php';
        ?>">
            DASHBOARD
        </a>

    </div>

    <!-- RIGHT SIDE -->
    <div class="nav-actions">

        <?php if (isset($_SESSION['user_id'])) { ?>

            <a href="logout.php" class="login-btn">
                LOGOUT
            </a>

        <?php } else { ?>

            <a href="login.php" class="login-btn">
                LOGIN
            </a>

        <?php } ?>

    </div>

</div>
<!-- =====================================================
     HERO
===================================================== -->

<section class="about-hero">


    <div class="hero-content">


        <div class="eyebrow">

            <i class="fa-solid fa-paw"></i>

            THE PAWCONNECT STORY

        </div>


        <h1>

            More Than Adoption.<br>

            <span>A Connection For Life.</span>

        </h1>


        <p>

            PawConnect was created with one simple belief:

            <strong>
                every animal deserves a safe place to belong.
            </strong>

        </p>


        <p>

            We bring rescued animals, caring people and
            animal welfare organisations together through
            one simple platform.

        </p>


        <a href="animals.php"
           class="hero-btn">

            Meet The Animals

            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>


    <div class="hero-visual">


        <div class="image-frame">

            <img src="firstimageabout.jpeg"
                 alt="Rescued animal">

        </div>


        <div class="floating-card">

            <i class="fa-solid fa-heart"></i>

            <div>

                <strong>
                    Every paw matters.
                </strong>

                <span>
                    Every connection counts.
                </span>

            </div>

        </div>


        <div class="paw-decoration paw-a">
            <i class="fa-solid fa-paw"></i>
        </div>

        <div class="paw-decoration paw-b">
            <i class="fa-solid fa-paw"></i>
        </div>

    </div>

</section>



<!-- =====================================================
     INTRO
===================================================== -->

<section class="intro-section">


    <div class="intro-label">

        WHY PAWCONNECT?

    </div>


    <div class="intro-grid">


        <h2>

            Because finding a home
            should never be the end
            of the story.

        </h2>


        <div>

            <p>

                Animal adoption is more than choosing a pet.
                It is the beginning of a relationship built on
                patience, responsibility and love.

            </p>


            <p>

                PawConnect makes that journey simpler by
                connecting animals waiting for homes with
                people ready to give them one.

            </p>

        </div>

    </div>

</section>



<!-- =====================================================
     HOW IT WORKS
===================================================== -->

<section class="journey-section">


    <div class="section-heading">

        <span>
            THE PAWCONNECT JOURNEY
        </span>

        <h2>
            From rescue to forever home.
        </h2>

        <p>
            A simple journey, with one purpose.
        </p>

    </div>


    <div class="journey">


        <div class="journey-card">

            <div class="number">
                01
            </div>

            <div class="journey-icon">

                <i class="fa-solid fa-paw"></i>

            </div>

            <h3>
                Discover
            </h3>

            <p>

                Browse animals who are looking
                for a second chance and learn
                about their stories.

            </p>

        </div>



        <div class="journey-line">

            <i class="fa-solid fa-paw"></i>

        </div>



        <div class="journey-card featured">

            <div class="number">
                02
            </div>

            <div class="journey-icon">

                <i class="fa-solid fa-heart"></i>

            </div>

            <h3>
                Connect
            </h3>

            <p>

                Submit an adoption request and
                begin the process of connecting
                with your future companion.

            </p>

        </div>



        <div class="journey-line">

            <i class="fa-solid fa-paw"></i>

        </div>



        <div class="journey-card">

            <div class="number">
                03
            </div>

            <div class="journey-icon">

                <i class="fa-solid fa-house"></i>

            </div>

            <h3>
                Belong
            </h3>

            <p>

                Complete the adoption journey
                and give an animal a place
                they can finally call home.

            </p>

        </div>

    </div>

</section>



<!-- =====================================================
     VALUES
===================================================== -->

<section class="values-section">


    <div class="values-heading">

        <span>
            WHAT WE BELIEVE
        </span>

        <h2>
            Four paws of our philosophy.
        </h2>

    </div>


    <div class="values-grid">


        <div class="value-card">

            <div class="value-number">
                01
            </div>

            <i class="fa-solid fa-heart"></i>

            <h3>
                Compassion
            </h3>

            <p>
                Every animal deserves patience,
                kindness and care.
            </p>

        </div>


        <div class="value-card">

            <div class="value-number">
                02
            </div>

            <i class="fa-solid fa-shield-heart"></i>

            <h3>
                Responsibility
            </h3>

            <p>
                Adoption is a commitment,
                not an impulse.
            </p>

        </div>


        <div class="value-card">

            <div class="value-number">
                03
            </div>

            <i class="fa-solid fa-handshake"></i>

            <h3>
                Trust
            </h3>

            <p>
                We believe every adoption
                should be transparent and safe.
            </p>

        </div>


        <div class="value-card">

            <div class="value-number">
                04
            </div>

            <i class="fa-solid fa-house"></i>

            <h3>
                Belonging
            </h3>

            <p>
                The goal isn't just a home.
                It is a forever home.
            </p>

        </div>

    </div>

</section>



<!-- =====================================================
     QUOTE
===================================================== -->

<section class="quote-section">


    <div class="quote-paw">

        <i class="fa-solid fa-paw"></i>

    </div>


    <h2>

        "A home is not just a place.
        It's where a paw feels safe."

    </h2>


    <p>
        That is what PawConnect is here to build.
    </p>

</section>



<!-- =====================================================
     CTA
===================================================== -->

<section class="about-cta">


    <div>

        <span>
            YOUR NEXT CONNECTION COULD CHANGE A LIFE.
        </span>

        <h2>
            Ready to meet your new best friend?
        </h2>

    </div>


    <a href="animals.php">

        Explore Animals

        <i class="fa-solid fa-paw"></i>

    </a>

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

            <a href="home.php">
                Home
            </a>

            <a href="animals.php">
                Available Animals
            </a>

            <a href="adopt.php">
                Adoption
            </a>

            <a href="stories.php">
                Adoption Stories
            </a>

        </div>



        <!-- SERVICES -->

        <div class="footer-links">

            <h3>
                Services
            </h3>

            <a href="care.php">
                Care After Adoption
            </a>

            <a href="petcare.php">
                Pet Care
            </a>

            <a href="ngo-partners.php">
                NGO Partners
            </a>

            <a href="mission.php">
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