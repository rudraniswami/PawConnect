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
          href="about.css">
          <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>


<body>


<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="nav">

    <!-- LOGO -->

    <div class="logo">

        <img src="logo.jpeg" alt="PawConnect Logo">

        <h2>PawConnect</h2>

    </div>


    <!-- CENTER MENU -->

    <div class="menu">

        <a href="home.php">
            HOME
        </a>


        <a href="about.php">
            ABOUT US
        </a>


        <!-- EXPLORE -->

        <div class="dropdown">

            <a href="#">
                EXPLORE
                <i class="fa-solid fa-chevron-down"></i>
            </a>


            <div class="dropdown-content">


                <!-- ABOUT -->

                <div class="column">

                    <h3>
                        About
                    </h3>

                    <a href="about.php">
                        About Us
                    </a>

                    <a href="mission.php">
                        Mission
                    </a>

                    <a href="contact.php">
                        Contact
                    </a>

                </div>


                <!-- ADOPTION -->

                <div class="column">

                    <h3>
                        Adoption
                    </h3>

                    <a href="animals.php">
                        Available Animals
                    </a>

                    <a href="care.php">
                        Care After Adoption
                    </a>

                    <a href="stories.php">
                        Adoption Stories
                    </a>

                </div>


                <!-- LOGIN -->

                <div class="column">

                    <h3>
                        Login
                    </h3>

                    <a href="login.php">
                        User Login
                    </a>

                    <a href="ngo_login.php">
                        NGO Login
                    </a>

                    <a href="admin_login.php">
                        Admin Login
                    </a>

                </div>


            </div>

        </div>


        <!-- ANIMALS -->

        <a href="animals.php">
            ANIMALS
        </a>


        <!-- DASHBOARD -->

        <a href="<?php
            echo isset($_SESSION['user_id'])
                ? 'user_dashboard.php'
                : 'login.php';
        ?>">
            DASHBOARD
        </a>

    </div>


    <!-- RIGHT SIDE -->

   <div class="main-nav-action">

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

<!-- ================= HERO ================= -->

<section class="about-hero">

    <div class="hero-content">

        <div class="small-title">

            <i class="fa-solid fa-paw"></i>

            ABOUT US

        </div>


        <h1>

            About

            <span>PawConnect</span>

        </h1>


        <div class="tagline">

            Connecting Hearts. Changing Lives.

            <span>♡</span>

        </div>


        <p>

            At PawConnect, we believe every animal deserves
            a second chance and a forever home. We rescue,
            heal, and rehabilitate animals in need and connect
            them with loving, responsible families.

        </p>


        <div class="hero-buttons">

            <a href="mission.php"
               class="primary-btn">

                Our Mission

                <i class="fa-solid fa-paw"></i>

            </a>


            <a href="#story"
               class="secondary-btn">

                Get Involved

                <i class="fa-regular fa-heart"></i>

            </a>

        </div>

    </div>


    <div class="hero-image">

        <img src="firstimageabout.jpeg"
             alt="Woman with rescued dog">


        <div class="hero-note">

            <div class="note-icon">

                <i class="fa-solid fa-heart"></i>

            </div>

            Because every paw has a story,
            and every story matters.

        </div>

    </div>

</section>



<!-- ================= OUR STORY ================= -->

<section class="story"
         id="story">


    <div class="story-gallery">

        <img src="maindog.jpg"
             class="story-main"
             alt="Rescue animal">


        <div class="story-small-images">

            <img src="dog-about.jpg"
                 alt="Dog">

            <img src="cat-about.jpg"
                 alt="Cat">

            <img src="carringdog.jpeg"
                 alt="Animal care">

        </div>

    </div>



    <div class="story-content">

        <div class="section-label">
            OUR STORY
        </div>


        <h2>

            Compassion Started
            This Journey.

        </h2>


        <p>

            What started as a small act of kindness has grown
            into a community movement. Every step we take is
            for the animals who cannot speak for themselves.

        </p>


        <p>

            PawConnect connects rescuers, veterinarians,
            NGOs and responsible adopters through one
            simple platform.

        </p>


        <!-- TIMELINE -->

        <div class="timeline">


            <div class="timeline-item">

                <div class="timeline-icon">

                    <i class="fa-solid fa-paw"></i>

                </div>

                <h4>2022</h4>

                <p>
                    A small group of animal
                    lovers came together.
                </p>

            </div>


            <div class="timeline-item">

                <div class="timeline-icon gold">

                    <i class="fa-solid fa-kit-medical"></i>

                </div>

                <h4>2023</h4>

                <p>
                    We started rescue and
                    medical care operations.
                </p>

            </div>


            <div class="timeline-item">

                <div class="timeline-icon">

                    <i class="fa-solid fa-house"></i>

                </div>

                <h4>2024</h4>

                <p>
                    Hundreds of adoptions
                    and countless lives changed.
                </p>

            </div>


            <div class="timeline-item">

                <div class="timeline-icon gold">

                    <i class="fa-solid fa-globe"></i>

                </div>

                <h4>Future</h4>

                <p>
                    A world where every animal
                    has a safe and loving home.
                </p>

            </div>


        </div>

    </div>

</section>



<!-- ================= VALUES ================= -->

<section class="values-section">


    <div class="values-box">


        <!-- CORE VALUES -->

        <div class="core-values">

            <h2 class="box-title">

                Our Core Values

                <i class="fa-solid fa-paw"></i>

            </h2>


            <div class="values-grid">


                <div class="value-item">

                    <div class="value-icon">

                        <i class="fa-solid fa-heart"></i>

                    </div>

                    <div>

                        <h3>Compassion</h3>

                        <p>
                            We treat every animal
                            with kindness and love.
                        </p>

                    </div>

                </div>


                <div class="value-item">

                    <div class="value-icon">

                        <i class="fa-solid fa-shield-heart"></i>

                    </div>

                    <div>

                        <h3>Trust</h3>

                        <p>
                            We build transparency
                            and faith in everything.
                        </p>

                    </div>

                </div>


                <div class="value-item">

                    <div class="value-icon">

                        <i class="fa-solid fa-users"></i>

                    </div>

                    <div>

                        <h3>Responsibility</h3>

                        <p>
                            We are committed to
                            animal welfare.
                        </p>

                    </div>

                </div>


                <div class="value-item">

                    <div class="value-icon">

                        <i class="fa-solid fa-leaf"></i>

                    </div>

                    <div>

                        <h3>Sustainability</h3>

                        <p>
                            We work for a better future
                            for animals and our planet.
                        </p>

                    </div>

                </div>


            </div>

        </div>



        <!-- IMPACT -->

        <div class="impact">

            <h2 class="box-title">

                Our Impact So Far

                <i class="fa-solid fa-paw"></i>

            </h2>


            <div class="impact-grid">


                <div class="impact-card">

                    <i class="fa-solid fa-paw"></i>

                    <h3>1200+</h3>

                    <p>
                        Animals Rescued
                    </p>

                </div>


                <div class="impact-card">

                    <i class="fa-solid fa-heart"></i>

                    <h3>750+</h3>

                    <p>
                        Successful Adoptions
                    </p>

                </div>


                <div class="impact-card">

                    <i class="fa-solid fa-kit-medical"></i>

                    <h3>3000+</h3>

                    <p>
                        Medical Treatments
                    </p>

                </div>


                <div class="impact-card">

                    <i class="fa-solid fa-users"></i>

                    <h3>100+</h3>

                    <p>
                        NGO & Shelter Partners
                    </p>

                </div>


            </div>

        </div>

    </div>

</section>



<!-- ================= TEAM ================= -->

<section class="team-section">


    <div class="team">

        <h2 class="section-heading">

            Meet Our Team

            <i class="fa-solid fa-paw"></i>

        </h2>


        <div class="team-grid">


            <div class="team-member">

                <img src="team1.png"
                     alt="Team member">

                <h3>Neha Patil</h3>

                <p>Founder & Director</p>

                <div class="social-icons">

                    <i class="fa-brands fa-facebook"></i>

                    <i class="fa-brands fa-instagram"></i>

                    <i class="fa-brands fa-linkedin"></i>

                </div>

            </div>


            <div class="team-member">

                <img src="team2.png"
                     alt="Team member">

                <h3>Dr. Amit Joshi</h3>

                <p>Veterinarian</p>

                <div class="social-icons">

                    <i class="fa-brands fa-facebook"></i>

                    <i class="fa-brands fa-instagram"></i>

                    <i class="fa-brands fa-linkedin"></i>

                </div>

            </div>


            <div class="team-member">

                <img src="team3.png"
                     alt="Team member">

                <h3>Sneha More</h3>

                <p>Operations Lead</p>

                <div class="social-icons">

                    <i class="fa-brands fa-facebook"></i>

                    <i class="fa-brands fa-instagram"></i>

                    <i class="fa-brands fa-linkedin"></i>

                </div>

            </div>


            <div class="team-member">

                <img src="team4.png"
                     alt="Team member">

                <h3>Rohan Kale</h3>

                <p>Community Lead</p>

                <div class="social-icons">

                    <i class="fa-brands fa-facebook"></i>

                    <i class="fa-brands fa-instagram"></i>

                    <i class="fa-brands fa-linkedin"></i>

                </div>

            </div>


        </div>

    </div>



    <!-- WHY CHOOSE -->

    <div class="why">

        <h2 class="section-heading">

            Why Choose PawConnect?

            <i class="fa-solid fa-paw"></i>

        </h2>


        <ul>

            <li>
                <i class="fa-solid fa-check"></i>
                Verified adoption process
            </li>

            <li>
                <i class="fa-solid fa-check"></i>
                Complete medical & vaccination records
            </li>

            <li>
                <i class="fa-solid fa-check"></i>
                Post-adoption support & guidance
            </li>

            <li>
                <i class="fa-solid fa-check"></i>
                Dedicated team and NGO network
            </li>

            <li>
                <i class="fa-solid fa-check"></i>
                Safe, transparent and trustworthy
            </li>

        </ul>

    </div>

</section>



<!-- ================= CTA ================= -->

<section class="cta">

    <div>

        <h2>
            Be a part of the change.
        </h2>

        <p>
            Together, we can give them
            the life they deserve.
        </p>

    </div>


    <div class="cta-buttons">

        <a href="animals.php"
           class="cta-primary">

            Adopt Now

            <i class="fa-solid fa-paw"></i>

        </a>

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