<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<title>Home</title>
<link rel="stylesheet" href="landing.css">
</head>
<body>

    <div id="splash">

    <div class="splash-content">

        <img src="logo.jpeg" class="logo1" alt="PawConnect Logo">

        <div class="text">
            <center><h1>PawConnect</h1></center>
            <p>------------------------------🤍------------------------------ </p>
            <center><p>Every rescued paw deserves a forever home</p></center>
        </div>

    </div>

</div>


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

        <?php } ?>

    </div>

</div>
<section class="hero">
    <div class="hero-text">
        <div class="badge">🛡 Trusted by 100+ NGOs & Shelters</div>
        <h1>Find Your <br><span>Forever Friend.</span><br>Change a Life Today.</h1>
        <p>PawConnect is a platform that connects rescued animals with loving families and helps NGOs provide the care they deserve.</p>
        <div class="hero-btn">
            <a href="animals.php" class="btn1"><i class="fa-solid fa-paw"></i> Explore Animals</a>
            <a href="adopt.php" class="gold-btn"><i class="fa-solid fa-heart"></i> Start Adoption</a>
        </div>
    </div>
    <div class="hero-image"></div>
</section>
   <!-- <button class="explore-btn">
    <i class="fa-solid fa-paw"></i>
    Explore Animals
</button> -->


<!-- featured pets -->
<section class="featured-pets">

    <div class="section-title">

        <div>
            <h2>FEATURED PETS</h2>
            <p>
                Meet Your Future Best Friend
                Find loving companions waiting for a forever home.
            </p>
        </div>

        <a href="animals.php" class="view-btn">
            View All →
        </a>

    </div>

    <div class="pet-container">

        <div class="pet-card">

            <img src="roxy.jpeg">

            <span class="pet-type dog">Dog</span>

            <h3>Roxy</h3>

            <p>3 Years • Golden Retriever</p>

            <div class="pet-info">
                <span>📍 Pune</span>
                <span class="status">Available</span>
            </div>

            <a href="roxy.php">
                <button>Meet Roxy</button>
            </a>

        </div>


        <div class="pet-card">

            <img src="cosmo.jpeg" alt="Milo">

            <span class="pet-type cat">Cat</span>

            <h3>Cosmo</h3>

            <p>1 Year • Domestic Shorthair Tabby</p>

            <div class="pet-info">
                <span>📍 Mumbai</span>
                <span class="status">Available</span>
            </div>

            <a href="cosmo.php">
                <button>Meet Cosmo</button>
            </a>

        </div>


        <div class="pet-card">

            <img src="buddy.jpeg">

            <span class="pet-type dog">Dog</span>

            <h3>Buddy</h3>

            <p>1.5 Years • Indie Mix</p>

            <div class="pet-info">
                <span>📍 Nashik</span>
                <span class="status">Available</span>
            </div>

            <a href="buddy.php">
                <button>Meet Buddy</button>
            </a>

        </div>


        <div class="pet-card">

            <img src="ivy.jpeg">

            <span class="pet-type dog">Dog</span>

            <h3>Ivy</h3>

            <p>3 Years • Labrador Retriever</p>

            <div class="pet-info">
                <span>📍 PCMC</span>
                <span class="status">Available</span>
            </div>

            <a href="ivy.php">
                <button>Meet Ivy</button>
            </a>

        </div>

    </div>
</section>
<!-- Features Section -->
<section class="features">
    <div class="features-heading">
        <h2>
            <i class="fa-solid fa-paw golden-paw"></i>
            Why PawConnect?
            <i class="fa-solid fa-paw golden-paw"></i>
        </h2>
        <p>Trusted adoption, complete pet records & lifelong support.</p>
    </div>

    <div class="features-grid">

        <div class="feature-card">
            <div class="cardworks">
                <div class="feature-icon">
                    <i class="fa-solid fa-shield-dog" style="color:#123C2A;"></i>
                </div>
            </div>
            <h3>Responsible Adoption</h3>
            <p>Every adoption is carefully reviewed to ensure the perfect match between pets and their forever family.</p>
        </div>

        <div class="feature-card">
            <div class="cardworks">
                <div class="feature-icon">
                    <i class="fa-solid fa-file-medical" style="color:#C89B32;"></i>
                </div>
            </div>
            <h3>Health Passport</h3>
            <p>Vaccination history, treatment records and medical notes in one secure profile.</p>
        </div>

        <div class="feature-card">
            <div class="cardworks">
                <div class="feature-icon">
                    <i class="fa-solid fa-heart-circle-check" style="color:#123C2A;"></i>
                </div>
            </div>
            <h3>Verified NGOs</h3>
            <p>We work only with trusted shelters and welfare organisations across India.</p>
        </div>

        <div class="feature-card">
            <div class="cardworks">
                <div class="feature-icon">
                    <i class="fa-solid fa-hand-holding-heart" style="color:#C89B32;"></i>
                </div>
            </div>
            <h3>Lifelong Support</h3>
            <p>Expert guidance, pet care resources and adoption support even after you take your pet home.</p>
        </div>

    </div>
</section>
<section class="adoption-process">

    <div class="process-heading">
        <h2>🐾 Adoption Process</h2>
        <p>Finding your perfect companion is simple and transparent.</p>
    </div>

    <div class="process-container">

        <div class="process-card">
            <div class="process-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <h3>Explore Pets</h3>
            <p>Browse verified pets and choose your perfect companion.</p>
        </div>

        <div class="arrow">
            <i class="fa-solid fa-arrow-right"></i>
        </div>

        <div class="process-card">
            <div class="process-icon">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <h3>Apply</h3>
            <p>Submit a quick adoption request with your basic details.</p>
        </div>

        <div class="arrow">
            <i class="fa-solid fa-arrow-right"></i>
        </div>

        <div class="process-card">
            <div class="process-icon">
                <i class="fa-solid fa-handshake"></i>
            </div>
            <h3>Meet & Verify</h3>
            <p>Connect with the shelter and complete a friendly verification.</p>
        </div>

        <div class="arrow">
            <i class="fa-solid fa-arrow-right"></i>
        </div>

        <div class="process-card">
            <div class="process-icon">
                <i class="fa-solid fa-heart"></i>
            </div>
            <h3>Take Home</h3>
            <p>Welcome your new family member and begin a lifelong journey.</p>
        </div>

    </div>

</section>

<!-- success stories -->
 <section class="success-stories">

    <div class="success-heading">
        <h2>🐾 Happy Tails</h2>
        <p>Every adoption creates a forever family.</p>
    </div>

    <div class="stories-container">

        <div class="story-card">
            <img src="koda.jpeg">
            <span class="story-badge">Adopted ❤</span>

            <div class="story-content">
                <h3>Koda</h3>

                <p>
                    Koda waited over a year before finding his forever
                    family. Today he enjoys long walks, endless cuddles,
                    and a home full of love.
                </p>

                <h4>— Priya & Koda</h4>
            </div>
        </div>

        <div class="story-card">
            <img src="tofu.jpeg">
            <span class="story-badge">Adopted ❤</span>

            <div class="story-content">
                <h3>Tofu</h3>

                <p>
                    Once rescued from the streets, Tofu now spends every
                    evening playing with her little humans and sleeping on
                    the couch.
                </p>

                <h4>— Rahul & Tofu</h4>
            </div>
        </div>

        <div class="story-card">
            <img src="kiki.jpeg" >
            <span class="story-badge">Adopted ❤</span>

            <div class="story-content">
                <h3>Kiki</h3>

                <p>
                    Kiki transformed from a shy kitten into the queen of
                    her new home thanks to patience, care and love.
                </p>

                <h4>— Sneha & Kiki</h4>
            </div>
        </div>

    </div>

</section>

<!-- pet care -->
 <section class="pet-care">

    <div class="care-heading">
        <h2>🐾 Pet Care Tips</h2>
        <p>Everything you need to keep your furry friend happy and healthy.</p>
    </div>

    <div class="care-container">

        <div class="care-card">
            <div class="care-icon">
                <i class="fa-solid fa-bowl-food"></i>
            </div>

            <h3>Healthy Nutrition</h3>

            <p>
                Learn what to feed your pet according to its age, breed and lifestyle.
            </p>

           
        </div>

        <div class="care-card">
            <div class="care-icon">
                <i class="fa-solid fa-syringe"></i>
            </div>

            <h3>Vaccination Guide</h3>

            <p>
                Stay updated with essential vaccines and regular health check-ups.
            </p>

            
        </div>

        <div class="care-card">
            <div class="care-icon">
                <i class="fa-solid fa-heart-pulse"></i>
            </div>

            <h3>Daily Wellness</h3>

            <p>
                Exercise, grooming and mental stimulation for a long and joyful life.
            </p>

            
        </div>

    </div>

</section>


<!-- community -->
 <section class="community">

    <div class="community-content">

        <span class="community-tag">🐾 Join Our Community</span>

        <h2>
            Every Paw Deserves a <br>
            Forever Home.
        </h2>

        <p>
            Whether you adopt, volunteer, donate or simply spread awareness,
            every small step helps create a safer future for rescued animals.
        </p>

        <div class="community-buttons">

            <a href="adopt.php" class="community-btn primary">
                <i class="fa-solid fa-paw"></i>
                Adopt Now
            </a>

            <a href="#" class="community-btn secondary">
                <i class="fa-solid fa-hand-holding-heart"></i>
                Become a Volunteer
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