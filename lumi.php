<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lumi | PawConnect</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="passport.css">

</head>


<body>


<!-- =====================================================
     NAVBAR
===================================================== -->



<div class="nav">
    <div class="logo">
        <img src="logo.jpeg" alt="PawConnect Logo">
        <h2>PawConnect</h2>
    </div>

    <div class="menu">
        <a href="home.php">HOME</a>
        <a href="about.php">ABOUT US</a>

        <div class="dropdown">

    <a href="#">
        EXPLORE <i class="fa-solid fa-chevron-down"></i>
    </a>

    <div class="dropdown-content">

        <!-- ABOUT -->

        <div class="column">

            <h3>About</h3>

            <a href="about.php">About Us</a>

            <a href="mission.php">Mission</a>

            <a href="contact.php">Contact</a>

        </div>


        <!-- ADOPTION -->

        <div class="column">

            <h3>Adoption</h3>

            <a href="animals.php">Available Animals</a>

            <a href="care.php">Care After Adoption</a>

            <a href="stories.php">Adoption Stories</a>

        </div>


        <!-- NGO -->

        <div class="column">

          <h3>NGO</h3>

            <a href="ngo_login.php">NGO Login</a>

            <a href="ngo_register.php">Register NGO</a>

            <a href="admin_login.php">Admin Login</a>

        </div>

    </div>

</div>

<a href="animals.php">ANIMALS</a>

<a href="contact.php">CONTACT</a>
    </div>


    <?php if (isset($_SESSION["user_id"]) || isset($_SESSION["ngo_id"])) { ?>

    <a href="logout.php" class="login-btn">
        LOGOUT
    </a>

<?php } else { ?>

    <a href="login.php" class="login-btn">
        LOGIN
    </a>

<?php } ?>

</div>



<!-- =====================================================
     PAW PASSPORT
===================================================== -->

<section class="passport-section">


    <div class="passport-heading">

        <p>PAWCONNECT</p>

        <h1>Digital Paw Passport</h1>

        <span>
            Every paw has a story worth knowing.
        </span>

    </div>



    <!-- PASSPORT CARD -->

    <div class="passport">


        <!-- =========================
             LEFT SIDE
        ========================== -->

        <div class="passport-left">


            <div class="passport-photo">

                <img src="Lumi.jpeg"
                     alt="Lumi- Indie Cat">


                <span>
                    <i class="fa-solid fa-circle-check"></i>
                    AVAILABLE
                </span>

            </div>


            <div class="pet-id">

                <small>
                    PET ID
                </small>

                <strong>
                    PC-lumi-002
                </strong>

            </div>


        </div>



        <!-- =========================
             RIGHT SIDE
        ========================== -->

        <div class="passport-right">


            <div class="passport-top">


                <div>

                    <p>
                        MEET YOUR COMPANION
                    </p>

                    <h2>
                      Lumi
                    </h2>

                    <h3>
                        Indie Cat
                    </h3>

                </div>


                <div class="paw-symbol">

                    <i class="fa-solid fa-paw"></i>

                </div>


            </div>



            <!-- BASIC INFORMATION -->

            <div class="passport-details">


                <div class="detail">

                    <small>
                        AGE
                    </small>

                    <strong>
                        2 Year
                    </strong>

                </div>


                <div class="detail">

                    <small>
                        GENDER
                    </small>

                    <strong>
                        Female
                    </strong>

                </div>


                <div class="detail">

                    <small>
                        HEALTH
                    </small>

                    <strong>
                       Vaccinated 
                    </strong>

                </div>


                <div class="detail">

                    <small>
                        STATUS
                    </small>

                    <strong>
                        Available
                    </strong>

                </div>


            </div>



            <!-- PERSONALITY -->

            <div class="passport-personality">

                <p>
                    PERSONALITY
                </p>


                <div class="tags">

                    <span>
                        ♥ Playful
                    </span>

                    <span>
                        ♥ calm
                    </span>

                    <span>
                        ♥ sweet
                    </span>

                    <span>
                        ♥ Gentle
                    </span>

                </div>

            </div>



            <!-- PASSPORT FOOTER -->

            <div class="passport-bottom">


                <div>

                    <small>
                        REGISTERED WITH
                    </small>

                    <strong>
                        PawConnect
                    </strong>

                </div>


                <div class="verified">

                    <i class="fa-solid fa-circle-check"></i>

                    Verified Profile

                </div>


            </div>


        </div>


    </div>


</section>



<!-- =====================================================
     ABOUT BELLA
===================================================== -->

<section class="about-section">


    <div class="about-heading">

        <p>
            HER STORY
        </p>

        <h2>
            Get to know Lumi
        </h2>

    </div>


    <div class="about-content">


        <p>

            Lumi is a loving and loyal Indie Cat
            looking for a caring family to call her own.
            She enjoys companionship and deserves a safe,
            comfortable home filled with patience and love.

        </p>


        <div class="care-info">


            <div>

                <i class="fa-solid fa-heart"></i>

                <span>
                    Loving companion
                </span>

            </div>


            <div>

                <i class="fa-solid fa-syringe"></i>

                <span>
                    Healthy
                </span>

            </div>


            <div>

                <i class="fa-solid fa-house"></i>

                <span>
                    Looking for a home
                </span>

            </div>


        </div>


    </div>

</section>



<!-- =====================================================
     ADOPTION CTA
===================================================== -->

<section class="adoption-cta">


    <div>

        <p>
                        LUMI IS WAITING
        </p>

        <h2>
            Could you be her forever family?
        </h2>

    </div>


    <!-- Login required before adoption -->

     <a href="adopt.php?pet_id=18">

        Adopt Lumi

    <i class="fa-solid fa-arrow-right"></i></a>


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