<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animals-PawConnect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="animals.css">
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
<div class="animalshero">
    <div class="animalshero-text">
        
        <h1>Every Paw<br><span>Has a Story.</span><br></h1>
        <p>Discover loving companions waiting for a place to call home. <br>Find the one whose story becomes a part of yours.</p>
        <div class="animalshero-btn">
            <a href="#animals" class="btn12"><i class="fa-solid fa-paw"></i>Meet Our Animals</a>
    </div>
</div>
</div>





<section class="companion-section">

    <div class="paw-decoration">🐾</div>

    <div class="companion-content">

        <p class="small-title">FIND YOUR FRIEND</p>

        <h2>
            A Heart Waiting
            To Be Loved
        </h2>

        <p>
            Whether you are looking for a playful dog
            or a gentle cat, every companion has a
            unique story waiting to become yours.
        </p>

        <div class="mini-points">

            <span>🐾 Loving Companions</span>
            <span>♡ Forever Homes</span>

        </div>

    </div>



    <div class="companion-images">


        <div class="pet-box dog-box">

            <img src="compdog.jpeg">

            <div>
                <h3>Dogs</h3>
                <a href="dogs.php">
                    Explore →
                </a>
            </div>

        </div>



        <div class="pet-box cat-box">

            <img src="compcat.jpeg">

            <div>
                <h3>Cats</h3>
                <a href="cats.php">
                    Explore →
                </a>
            </div>

        </div>


    </div>


</section>

<!-- featured companion -->

<!-- FEATURED COMPANIONS SECTION -->

<section class="featured-companions" id="animals">

    <div class="featured-heading">

        <p>OUR FRIENDS</p>

        <h2>Meet Our Companions</h2>

        <span>
            Each one has a story, a personality, and a heart waiting for a home.
        </span>

    </div>


    <div class="animal-grid">


        <!-- CARD 1 -->

        <div class="animal-card">

            <div class="animal-image">

                <img src="bella.jpeg" alt="Bella">

                <span class="status">
                    Available
                </span>

            </div>


            <div class="animal-details">

                <h3>Bella</h3>

                <p class="breed">
                    Golden Retriever
                </p>


                <div class="info">

                    <span>♀ 2 Years</span>

                    <span>📍 Pune</span>

                </div>


                <div class="tags">

                    <span>Vaccinated</span>

                    <span>Friendly</span>

                </div>


                <a href="bella.php">
                    Meet Bella
                </a>

            </div>

        </div>




        <!-- CARD 2 -->


        <div class="animal-card">

            <div class="animal-image">

                <img src="aster.jpeg">

                <span class="status">
                    Available
                </span>

            </div>


            <div class="animal-details">

                <h3>Aster</h3>

                <p class="breed">
                    Persian Cat
                </p>


                <div class="info">

                    <span>♀ 1 Year</span>

                    <span>📍 Pune</span>

                </div>


                <div class="tags">

                    <span>Healthy</span>

                    <span>Calm</span>

                </div>


                <a href="aster.php">
                    Meet Aster
                </a>

            </div>

        </div>





        <!-- CARD 3 -->


        <div class="animal-card">

            <div class="animal-image">

                <img src="nova.jpeg" >

                <span class="status">
                    Available
                </span>

            </div>


            <div class="animal-details">

                <h3>Nova</h3>

                <p class="breed">
                    Labrador
                </p>


                <div class="info">

                    <span>♂ 3 Years</span>

                    <span>📍 Pune</span>

                </div>


                <div class="tags">

                    <span>Active</span>

                    <span>Loyal</span>

                </div>


                <a href="nova.php">
                    Meet Nova
                </a>

            </div>

        </div>


    </div>

</section>
<!-- 
journey section -->

<!-- ANIMAL STORIES SECTION -->

<section class="journey-section">

    <div class="journey-heading">

        <p>THEIR STORIES</p>

        <h2>Their Journey Matters</h2>

        <span>
            Every paw carries a story of hope, care, and a second chance.
        </span>

    </div>



    <div class="story-container">


        <div class="story-image">

            <img src="journey.jpeg" alt="Animal Story">

        </div>



        <div class="story-content">

            <h3>From Rescue To Forever Home</h3>

            <p>
                Every animal deserves love, safety, and a family.
                Through care and compassion, they get a second chance
                to live a happy life.
            </p>


            <div class="story-points">

                <div>
                    <strong>1876</strong>
                    <span>Rescued with care</span>
                </div>


                <div>
                    <strong>1058</strong>
                    <span>Health & support</span>
                </div>


                <div>
                    <strong>679</strong>
                    <span>Forever family</span>
                </div>

            </div>


            <a href="#">
                Read More Stories
            </a>


        </div>


    </div>


</section>


<!-- footer -->
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