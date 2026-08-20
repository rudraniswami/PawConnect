<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NGO Partners | PawConnect</title>

    <!-- ONLY EXTERNAL STYLESHEET -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- PAGE CSS -->
    <link rel="stylesheet" href="ngopartners.css">

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

    <!-- MOBILE MENU TOGGLE -->
     

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

<section class="hero">

    <div class="hero-container">


        <!-- HERO TEXT -->

        <div class="hero-text">

            <p class="hero-small">
                <i class="fa-solid fa-paw"></i>
                TOGETHER, WE CREATE HOPE
            </p>


            <h1>
                Our NGO
                <span>Partners</span>
            </h1>


            <p class="hero-description">

                PawConnect proudly works alongside organizations
                dedicated to rescuing, caring for and protecting
                animals in need.

            </p>


            <div class="hero-decoration">

                <span></span>

                <i class="fa-solid fa-paw"></i>

                <span></span>

            </div>

        </div>


        <!-- HERO IMAGE -->

        <div class="hero-image">

            <img src="ngo-hero.jpg" alt="NGO Volunteers">


            <div class="hero-image-tag">

                <i class="fa-solid fa-heart"></i>

                Making a Difference Together

            </div>

        </div>

    </div>

</section>



<!-- =====================================================
     MISSION STRIP
===================================================== -->

<section class="mission-wrapper">

    <div class="mission-strip">


        <div class="mission-item">

            <div class="mission-icon">
                <i class="fa-solid fa-paw"></i>
            </div>

            <div>
                <h4>Rescue</h4>
                <p>Saving animals in need</p>
            </div>

        </div>


        <div class="mission-item">

            <div class="mission-icon">
                <i class="fa-solid fa-kit-medical"></i>
            </div>

            <div>
                <h4>Care</h4>
                <p>Supporting better health</p>
            </div>

        </div>


        <div class="mission-item">

            <div class="mission-icon">
                <i class="fa-solid fa-house"></i>
            </div>

            <div>
                <h4>Adoption</h4>
                <p>Finding loving homes</p>
            </div>

        </div>


        <div class="mission-item">

            <div class="mission-icon">
                <i class="fa-solid fa-heart"></i>
            </div>

            <div>
                <h4>Hope</h4>
                <p>Creating brighter futures</p>
            </div>

        </div>


    </div>

</section>



<!-- =====================================================
     NGO PARTNERS
===================================================== -->

<section class="partners-section">

    <div class="section-container">


        <div class="section-heading">

            <p>OUR COMMUNITY</p>

            <h2>
                <i class="fa-solid fa-paw"></i>
                Trusted NGO Partners
            </h2>

            <span>
                Together, we are creating a kinder world for animals.
            </span>

        </div>



        <div class="ngo-grid">


            <!-- NGO 1 -->

            <div class="ngo-card">

                <div class="ngo-image">

                    <img src="ngo1.jpg"
                         alt="Happy Paws Foundation">

                    <div class="ngo-icon">
                        <i class="fa-solid fa-paw"></i>
                    </div>

                </div>


                <div class="ngo-body">

                    <h3>Happy Paws Foundation</h3>

                    <p class="location">
                        <i class="fa-solid fa-location-dot"></i>
                        Pune, Maharashtra
                    </p>

                    <div class="services">

                        <span>Rescue</span>
                        <span>Medical Care</span>
                        <span>Adoption</span>

                    </div>

                </div>

            </div>



            <!-- NGO 2 -->

            <div class="ngo-card">

                <div class="ngo-image">

                    <img src="ngo2.jpg"
                         alt="Care Animals Trust">

                    <div class="ngo-icon">
                        <i class="fa-solid fa-heart"></i>
                    </div>

                </div>


                <div class="ngo-body">

                    <h3>Care Animals Trust</h3>

                    <p class="location">
                        <i class="fa-solid fa-location-dot"></i>
                        Mumbai, Maharashtra
                    </p>

                    <div class="services">

                        <span>Rescue</span>
                        <span>Treatment</span>
                        <span>Adoption</span>

                    </div>

                </div>

            </div>



            <!-- NGO 3 -->

            <div class="ngo-card">

                <div class="ngo-image">

                    <img src="ngo3.jpg"
                         alt="Paws of Hope NGO">

                    <div class="ngo-icon">
                        <i class="fa-solid fa-house"></i>
                    </div>

                </div>


                <div class="ngo-body">

                    <h3>Paws of Hope NGO</h3>

                    <p class="location">
                        <i class="fa-solid fa-location-dot"></i>
                        Nagpur, Maharashtra
                    </p>

                    <div class="services">

                        <span>Shelter</span>
                        <span>Vaccination</span>
                        <span>Adoption</span>

                    </div>

                </div>

            </div>



            <!-- NGO 4 -->

            <div class="ngo-card">

                <div class="ngo-image">

                    <img src="ngo4.jpg"
                         alt="Second Chance Shelter">

                    <div class="ngo-icon">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>

                </div>


                <div class="ngo-body">

                    <h3>Second Chance Shelter</h3>

                    <p class="location">
                        <i class="fa-solid fa-location-dot"></i>
                        Nashik, Maharashtra
                    </p>

                    <div class="services">

                        <span>Rescue</span>
                        <span>Care</span>
                        <span>Rehabilitation</span>

                    </div>

                </div>

            </div>



            <!-- NGO 5 -->

            <div class="ngo-card">

                <div class="ngo-image">

                    <img src="ngo5.jpg"
                         alt="Stray Safe India">

                    <div class="ngo-icon">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>

                </div>


                <div class="ngo-body">

                    <h3>Stray Safe India</h3>

                    <p class="location">
                        <i class="fa-solid fa-location-dot"></i>
                        Aurangabad, Maharashtra
                    </p>

                    <div class="services">

                        <span>Rescue</span>
                        <span>Sterilization</span>
                        <span>Adoption</span>

                    </div>

                </div>

            </div>



            <!-- NGO 6 -->

            <div class="ngo-card">

                <div class="ngo-image">

                    <img src="ngo6.jpg"
                         alt="Voice for Animals">

                    <div class="ngo-icon">
                        <i class="fa-solid fa-volume-high"></i>
                    </div>

                </div>


                <div class="ngo-body">

                    <h3>Voice for Animals</h3>

                    <p class="location">
                        <i class="fa-solid fa-location-dot"></i>
                        Thane, Maharashtra
                    </p>

                    <div class="services">

                        <span>Rescue</span>
                        <span>Rehabilitation</span>
                        <span>Adoption</span>

                    </div>

                </div>

            </div>



            <!-- NGO 7 -->

            <div class="ngo-card">

                <div class="ngo-image">

                    <img src="ngo7.jpg"
                         alt="Animal Care Society">

                    <div class="ngo-icon">
                        <i class="fa-solid fa-user-group"></i>
                    </div>

                </div>


                <div class="ngo-body">

                    <h3>Animal Care Society</h3>

                    <p class="location">
                        <i class="fa-solid fa-location-dot"></i>
                        Kolhapur, Maharashtra
                    </p>

                    <div class="services">

                        <span>Rescue</span>
                        <span>Medical</span>
                        <span>Adoption</span>

                    </div>

                </div>

            </div>



            <!-- NGO 8 -->

            <div class="ngo-card">

                <div class="ngo-image">

                    <img src="ngo8.jpg"
                         alt="Love Paws Foundation">

                    <div class="ngo-icon">
                        <i class="fa-solid fa-heart"></i>
                    </div>

                </div>


                <div class="ngo-body">

                    <h3>Love Paws Foundation</h3>

                    <p class="location">
                        <i class="fa-solid fa-location-dot"></i>
                        Solapur, Maharashtra
                    </p>

                    <div class="services">

                        <span>Rescue</span>
                        <span>Care</span>
                        <span>Adoption</span>

                    </div>

                </div>

            </div>


        </div>

    </div>

</section>



<!-- =====================================================
     IMPACT
===================================================== -->

<section class="impact-wrapper">

    <div class="impact-section">

        <div class="impact-heading">

            <p>OUR COLLECTIVE IMPACT</p>

            <h2>Every Paw Matters</h2>

        </div>


        <div class="impact-grid">


            <div class="impact-item">

                <i class="fa-solid fa-building"></i>

                <h3>500+</h3>

                <p>NGO Partners</p>

            </div>


            <div class="impact-item">

                <i class="fa-solid fa-paw"></i>

                <h3>12,500+</h3>

                <p>Animals Rescued</p>

            </div>


            <div class="impact-item">

                <i class="fa-solid fa-house"></i>

                <h3>3,200+</h3>

                <p>Successful Adoptions</p>

            </div>


            <div class="impact-item">

                <i class="fa-solid fa-map-location-dot"></i>

                <h3>28+</h3>

                <p>Cities Covered</p>

            </div>


        </div>

    </div>

</section>



<!-- =====================================================
     CTA
===================================================== -->

<section class="cta-wrapper">

    <div class="ngo-cta">


        <div class="cta-content">

            <p>
                <i class="fa-solid fa-paw"></i>
                PAWCONNECT COMMUNITY
            </p>


            <h2>
                Together, we can give every animal
                a second chance.
            </h2>


            <span>
                Our NGO partners make this mission possible
                through compassion, care and teamwork.
            </span>

        </div>


        <div class="cta-icon">

            <i class="fa-solid fa-hand-holding-heart"></i>

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

            <a href="home.php">
                Home
            </a>

            <a href="animals.php">
                Available Animals
            </a>

            <a href="about.php">
                About us
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