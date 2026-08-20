<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Care | PawConnect</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="care.css">

</head>

<body>


<!-- =====================================================
     NAVBAR
===================================================== -->

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
     CARE HERO
===================================================== -->

<section class="care-hero">

    <img
        src="carehero.jpeg"
        alt="Dog relaxing comfortably at home"
        class="care-hero-image"
    >

    <div class="care-hero-overlay"></div>


    <div class="care-hero-content">

        <span class="care-eyebrow">

            <i class="fa-solid fa-paw"></i>

            LIFE AFTER ADOPTION

        </span>


        <h1>

            Home is where

            <span>
                their story continues.
            </span>

        </h1>


        <p>

            Adoption gives them a home.
            Care, patience and love help them
            truly feel that they belong.

        </p>

    </div>

</section>



<!-- =====================================================
     EMOTIONAL INTRO
===================================================== -->

<section class="care-story">


    <div class="story-image">

        <img
            src="care1.jpeg"
            alt="Adopted pet"
        >

    </div>


    <div class="story-content">

        <span class="small-label">
            AFTER THE ADOPTION
        </span>


        <h2>

            The first few days

            <span>
                matter more than you think.
            </span>

        </h2>


        <p>

            For your new companion, everything has changed.
            New smells. New sounds. New people. A new place
            to call home.

        </p>


        <p>

            Don't worry about getting everything perfect.
            Give them time, consistency and a safe space.
            Slowly, unfamiliar moments become familiar ones.

        </p>


        <div class="story-quote">

            <i class="fa-solid fa-quote-left"></i>

            <p>
                “Trust isn't built in a day.
                It's built in all the little moments.”
            </p>

        </div>

    </div>

</section>



<!-- =====================================================
     CARE GUIDE
===================================================== -->

<section class="care-guide" id="care-guide">


    <div class="care-heading">

        <span class="small-label">
            THE ESSENTIALS
        </span>


        <h2>

            Four simple things

            <span>
                make a big difference.
            </span>

        </h2>


        <p>

            You don't need to be a perfect pet parent.
            Start with the basics and let your bond grow naturally.

        </p>

    </div>



    <div class="care-feature-grid">


        <!-- SAFE SPACE -->

        <div class="care-feature large">

            <div class="feature-image">

                <img
                    src="care2.jpeg"
                    alt="Pet resting safely"
                >

            </div>


            <div class="feature-content">

                <span>
                    01
                </span>


                <h3>
                    Give them a safe space.
                </h3>


                <p>

                    Create one quiet corner where your pet can
                    retreat whenever they need rest or a little
                    peace.

                </p>


                <div class="feature-tip">

                    <i class="fa-solid fa-heart"></i>

                    Let them explore their new home
                    at their own pace.

                </div>

            </div>

        </div>



        <!-- ROUTINE -->

        <div class="care-feature">

            <div class="feature-icon">

                <i class="fa-solid fa-clock"></i>

            </div>


            <span class="feature-number">
                02
            </span>


            <h3>
                Build a routine.
            </h3>


            <p>

                Regular meals, walks, playtime and sleep
                help your companion understand that
                their new world is safe.

            </p>


            <div class="feature-line"></div>


            <small>
                Consistency creates comfort.
            </small>

        </div>



        <!-- HEALTH -->

        <div class="care-feature">

            <div class="feature-icon">

                <i class="fa-solid fa-heart-pulse"></i>

            </div>


            <span class="feature-number">
                03
            </span>


            <h3>
                Keep an eye on their health.
            </h3>


            <p>

                Stay updated with vaccinations,
                checkups, nutrition and any changes
                in behaviour.

            </p>


            <div class="feature-line"></div>


            <small>
                Prevention is part of love.
            </small>

        </div>



        <!-- PATIENCE -->

        <div class="care-feature wide">

            <div class="wide-icon">

                <i class="fa-solid fa-hand-holding-heart"></i>

            </div>


            <div>

                <span class="feature-number">
                    04
                </span>


                <h3>
                    Let trust happen naturally.
                </h3>


                <p>

                    Some pets run towards you immediately.
                    Others need more time. Don't force the bond.
                    Be patient, be present and let them come to you.

                </p>

            </div>

        </div>

    </div>

</section>



<!-- =====================================================
     30 DAY JOURNEY
===================================================== -->

<section class="journey-section">


    <div class="journey-intro">

        <span class="small-label">
            YOUR FIRST 30 DAYS
        </span>


        <h2>

            From unfamiliar

            <span>
                to family.
            </span>

        </h2>


        <p>

            Every pet settles differently. Here's a gentle
            guide to help you understand what those first
            few weeks can look like.

        </p>

    </div>



    <div class="journey-wrapper">


        <div class="journey-step">

            <div class="journey-number">
                01
            </div>


            <div class="journey-icon">

                <i class="fa-solid fa-house"></i>

            </div>


            <div class="journey-text">

                <span>
                    WEEK ONE
                </span>


                <h3>
                    Let them settle.
                </h3>


                <p>

                    Keep things calm and predictable.
                    Give them space to understand
                    their new surroundings.

                </p>

            </div>

        </div>



        <div class="journey-step">

            <div class="journey-number">
                02
            </div>


            <div class="journey-icon">

                <i class="fa-solid fa-bowl-food"></i>

            </div>


            <div class="journey-text">

                <span>
                    WEEK TWO
                </span>


                <h3>
                    Find your rhythm.
                </h3>


                <p>

                    Establish regular meals, walks,
                    playtime and quiet moments together.

                </p>

            </div>

        </div>



        <div class="journey-step">

            <div class="journey-number">
                03
            </div>


            <div class="journey-icon">

                <i class="fa-solid fa-paw"></i>

            </div>


            <div class="journey-text">

                <span>
                    WEEK THREE
                </span>


                <h3>
                    Build confidence.
                </h3>


                <p>

                    Introduce new experiences slowly
                    while helping them feel secure.

                </p>

            </div>

        </div>



        <div class="journey-step">

            <div class="journey-number">
                04
            </div>


            <div class="journey-icon">

                <i class="fa-solid fa-heart"></i>

            </div>


            <div class="journey-text">

                <span>
                    WEEK FOUR
                </span>


                <h3>
                    Feel like family.
                </h3>


                <p>

                    By now, little routines begin
                    turning into memories.

                </p>

            </div>

        </div>

    </div>

</section>



<!-- =====================================================
     PAWCONNECT CARE COMPANION
===================================================== -->

<section class="care-companion">


    <div class="companion-image">

        <img
            src="care3.jpeg"
            alt="Happy adopted pet with family"
        >

    </div>


    <div class="companion-content">

        <span class="small-label">
            PAWCONNECT CARE COMPANION
        </span>


        <h2>

            Adoption doesn't

            <span>
                end at “Adopted”.
            </span>

        </h2>


        <p>

            Your responsibility continues long after
            your pet walks through the door.
            Keep track of the little things that help
            them live a happy, healthy life.

        </p>


        <div class="companion-list">


            <div>

                <i class="fa-solid fa-syringe"></i>

                <span>
                    Vaccination reminders
                </span>

            </div>


            <div>

                <i class="fa-solid fa-calendar-check"></i>

                <span>
                    Health check-up tracking
                </span>

            </div>


            <div>

                <i class="fa-solid fa-bowl-food"></i>

                <span>
                    Feeding & routine guidance
                </span>

            </div>


            <div>

                <i class="fa-solid fa-scissors"></i>

                <span>
                    Grooming & hygiene reminders
                </span>

            </div>

        </div>

    </div>

</section>



<!-- =====================================================
     PAWCONNECT CARE SUPPORT
===================================================== -->

<section class="care-final">


    <div class="care-final-inner">


        <div class="care-final-icon">

            <i class="fa-solid fa-paw"></i>

        </div>



        <div class="care-final-content">

            <span class="care-final-label">
                PAWCONNECT CARE SUPPORT
            </span>


            <h2>

                Adopted today.

                <em>
                    Supported every day.
                </em>

            </h2>


            <p>

                Your journey with your new companion doesn't end
                after adoption. If you need guidance about
                vaccination, nutrition, hygiene or everyday care,
                PawConnect is here to help.

            </p>


            <div class="care-support-row">


                <div>

                    <i class="fa-solid fa-syringe"></i>

                    <span>
                        Vaccination
                    </span>

                </div>


                <div>

                    <i class="fa-solid fa-bowl-food"></i>

                    <span>
                        Nutrition
                    </span>

                </div>


                <div>

                    <i class="fa-solid fa-heart-pulse"></i>

                    <span>
                        Health
                    </span>

                </div>


                <div>

                    <i class="fa-solid fa-paw"></i>

                    <span>
                        Daily Care
                    </span>

                </div>

            </div>

        </div>



        <div class="care-final-action">

            <span>
                Need guidance?
            </span>


            <a
                href="contact.php"
                class="care-final-btn"
            >

                Contact PawConnect

                <i class="fa-solid fa-arrow-right"></i>

            </a>

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

                <img
                    src="logo.jpeg"
                    alt="PawConnect Logo"
                >

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