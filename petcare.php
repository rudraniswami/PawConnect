<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pet Care | PawConnect</title>

    <!-- ONLY FONT AWESOME -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="petcare.css">
</head>

<body>

<!-- =====================================================
     NAVBAR
===================================================== -->

<nav class="nav">

    <div class="logo">
        <img src="logo.jpeg" alt="PawConnect Logo">
        <h2>PawConnect</h2>
    </div>

    <div class="menu">

        <a href="home.php">HOME</a>

        <a href="about.php">ABOUT US</a>

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

    <div class="main-nav-action">

        <?php if (isset($_SESSION['user_id'])) { ?>

            <a href="logout.php" class="login-btn">LOGOUT</a>

        <?php } else { ?>

            <a href="login.php" class="login-btn">LOGIN</a>

        <?php } ?>

    </div>

</nav>


<!-- =====================================================
     HERO
===================================================== -->

<section class="hero">

    <div class="hero-content">

        <div class="hero-text">

            <p class="tag">
                <i class="fa-solid fa-paw"></i>
                Happy Pets, Healthy Life
            </p>

            <h1>
                Pet Care<br>
                Suggestions
            </h1>

            <p class="description">
                Your pet's well-being is our priority.
                Explore expert-backed tips and daily care
                guides to keep your furry friend happy,
                healthy and active.
            </p>

            <div class="buttons">

                <a href="#guides" class="btn-green">
                    Daily Care Tips
                    <i class="fa-solid fa-paw"></i>
                </a>

            </div>

        </div>


        <div class="hero-image">

            <img src="petcare.png" alt="Happy Dog and Cat">

            <div class="note">

                <i class="fa-solid fa-paw"></i>

                <span>
                    Small care today,<br>
                    happier tomorrow.
                </span>

            </div>

        </div>

    </div>

</section>


<!-- =====================================================
     FEATURES
===================================================== -->

<section class="features">

    <div class="container">

        <div class="feature-grid">

            <div class="feature-item">
                <div class="circle">
                    <i class="fa-solid fa-bowl-food"></i>
                </div>

                <h3>Nutritious Food</h3>

                <p>Balanced diet for stronger pets.</p>
            </div>


            <div class="feature-item">
                <div class="circle">
                    <i class="fa-solid fa-paw"></i>
                </div>

                <h3>Regular Exercise</h3>

                <p>Daily activity keeps them fit and happy.</p>
            </div>


            <div class="feature-item">
                <div class="circle">
                    <i class="fa-solid fa-kit-medical"></i>
                </div>

                <h3>Health Checkups</h3>

                <p>Routine checkups for a healthy life.</p>
            </div>


            <div class="feature-item">
                <div class="circle">
                    <i class="fa-solid fa-scissors"></i>
                </div>

                <h3>Grooming</h3>

                <p>Clean pets are happy pets.</p>
            </div>


            <div class="feature-item">
                <div class="circle">
                    <i class="fa-solid fa-heart"></i>
                </div>

                <h3>Love & Care</h3>

                <p>Give them love, they give you joy.</p>
            </div>

        </div>

    </div>

</section>


<!-- =====================================================
     GUIDES
===================================================== -->

<section class="guides" id="guides">

    <div class="container">

        <div class="heading">

            <h2>
                <i class="fa-solid fa-leaf"></i>
                Pet Care Guides
                <i class="fa-solid fa-leaf"></i>
            </h2>

            <p>
                Everything you need to know for a better life for your pet.
            </p>

        </div>


        <div class="guides-grid">


            <div class="card">

                <img src="diet.png" alt="Healthy Diet">

                <div class="card-body">

                    <span>
                        <i class="fa-solid fa-bowl-food"></i>
                    </span>

                    <h3>Healthy Diet</h3>

                    <p>
                        Choose the right food for your
                        pet's age and breed.
                    </p>

                </div>

            </div>


            <div class="card">

                <img src="exercise.jpg" alt="Exercise">

                <div class="card-body">

                    <span>
                        <i class="fa-solid fa-dog"></i>
                    </span>

                    <h3>Exercise & Play</h3>

                    <p>
                        Fun activities and daily exercise
                        keep them energetic.
                    </p>

                </div>

            </div>


            <div class="card">

                <img src="health.jpg" alt="Health">

                <div class="card-body">

                    <span>
                        <i class="fa-solid fa-kit-medical"></i>
                    </span>

                    <h3>Health & Hygiene</h3>

                    <p>
                        Vaccination, hygiene and regular
                        vet visits are important.
                    </p>

                </div>

            </div>


            <div class="card">

                <img src="grooming.jpg" alt="Grooming">

                <div class="card-body">

                    <span>
                        <i class="fa-solid fa-scissors"></i>
                    </span>

                    <h3>Grooming Tips</h3>

                    <p>
                        Brushing, bathing and nail care
                        for a clean and healthy pet.
                    </p>

                </div>

            </div>


            <div class="card">

                <img src="training.jpg" alt="Training">

                <div class="card-body">

                    <span>
                        <i class="fa-solid fa-heart"></i>
                    </span>

                    <h3>Behavior & Training</h3>

                    <p>
                        Positive training builds trust
                        and good behavior.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =====================================================
     EMERGENCY
===================================================== -->

<section class="emergency">

    <div class="container">

        <div class="emergency-row">

            <div class="emergency-left">

                <h2>
                    <i class="fa-solid fa-kit-medical"></i>
                    Emergency Care
                </h2>

                <p>
                    Know what to do in an emergency situation.
                </p>

            </div>

            <div class="emergency-text">

                <h3>
                    Because every second<br>
                    can save a life.
                </h3>

            </div>

        </div>

    </div>

</section>


<!-- =====================================================
     QUICK TIPS
===================================================== -->

<section class="tips" id="tips">

    <div class="container">

        <div class="heading">

            <h2>
                Quick Daily Tips
                <i class="fa-solid fa-heart"></i>
            </h2>

        </div>


        <div class="tips-grid">


            <div class="tip-item">

                <div class="tip-circle">
                    <i class="fa-solid fa-droplet"></i>
                </div>

                <h3>Fresh Water</h3>

                <p>
                    Always keep clean water available.
                </p>

            </div>


            <div class="tip-item">

                <div class="tip-circle">
                    <i class="fa-regular fa-clock"></i>
                </div>

                <h3>Routine</h3>

                <p>
                    Maintain a daily feeding schedule.
                </p>

            </div>


            <div class="tip-item">

                <div class="tip-circle">
                    <i class="fa-solid fa-house"></i>
                </div>

                <h3>Safe Space</h3>

                <p>
                    Give them a clean, comfortable space.
                </p>

            </div>


            <div class="tip-item">

                <div class="tip-circle">
                    <i class="fa-solid fa-heart"></i>
                </div>

                <h3>Affection</h3>

                <p>
                    Spend quality time with your pet.
                </p>

            </div>


            <div class="tip-item">

                <div class="tip-circle">
                    <i class="fa-solid fa-eye"></i>
                </div>

                <h3>Stay Alert</h3>

                <p>
                    Watch for changes in their behavior.
                </p>

            </div>

        </div>

    </div>

</section>


<!-- =====================================================
     CTA
===================================================== -->

<section class="cta">

    <div class="container">

        <div class="cta-row">

            <div class="cta-image">

                <img src="petcare-bottom.jpg" alt="Happy Pets">

            </div>

            <div class="cta-text">

                <h2>
                    A little care goes a long way.
                    <br>
                    Happy pet, happy home.
                </h2>

            </div>

        </div>

    </div>

</section>


<!-- =====================================================
     FOOTER
===================================================== -->

<footer class="footer">

    <div class="footer-top">

        <div class="footer-about">

            <div class="footer-logo">

                <img src="logo.jpeg" alt="PawConnect Logo">

                <h2>PawConnect</h2>

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


        <div class="footer-links">

            <h3>Explore</h3>

            <a href="home.php">Home</a>
            <a href="animals.php">Available Animals</a>
            <a href="adopt.php">Adoption</a>
            <a href="stories.php">Adoption Stories</a>

        </div>


        <div class="footer-links">

            <h3>Services</h3>

            <a href="care.php">Care After Adoption</a>
            <a href="petcare.php">Pet Care</a>
            <a href="ngo-partners.php">NGO Partners</a>
            <a href="mission.php">Our Mission</a>

        </div>


        <div class="footer-contact">

            <h3>Contact</h3>

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


    <div class="footer-bottom">

        <p>
            © 2026 PawConnect • Connecting every paw with care,
            compassion & a place to belong.
        </p>

    </div>

</footer>

</body>
</html>