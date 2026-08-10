<?php
include "db.php";

// Pull dogs added by NGOs through addanimal.php
$stmt = $conn->prepare("SELECT * FROM animals WHERE type = ? ORDER BY created_at DESC");
$type = "Dog";
$stmt->bind_param("s", $type);
$stmt->execute();
$db_dogs = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dogs | PawConnect</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<link rel="stylesheet" href="dogs.css">

</head>


<body>


<!-- NAVBAR -->

   <div class="nav">
    <div class="logo">
        <img src="logo.jpeg" alt="PawConnect Logo">
        <h2>PawConnect</h2>
    </div>

    <div class="menu">
        <a href="home.php">HOME</a>
        <a href="animals.php">ANIMALS</a>

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

            <a href="dashboard.php">Dashboard</a>

            <a href="addanimal.php">Add Animal</a>

        </div>

    </div>

</div>

<a href="adopt.php">ADOPT</a>

<a href="contact.php">CONTACT</a>
    </div>

    <?php if (isset($_SESSION["user_id"]) || isset($_SESSION["ngo_id"])) { ?>

    <a href="logout.php" class="login-btn">
        LOGOUT
    </a>

<?php } else { ?>

    <?php if (isset($_SESSION["user_id"]) || isset($_SESSION["ngo_id"])) { ?>

    <a href="logout.php" class="login-btn">
        LOGOUT
    </a>

<?php } else { ?>

    <a href="login.php" class="login-btn">
        LOGIN
    </a>

<?php } ?>

<?php } ?>
</div>




<!-- HERO -->

<section class="dog-hero">

<div class="hero-content">

<p>FIND YOUR FOREVER FRIEND</p>

<h1>
Some Friendships
Begin With A
<span>Paw</span>
</h1>


<h3>
Discover loving dogs waiting for a family
where they belong.
</h3>




</div>

</section>

<!-- DOG COLLECTION SECTION -->

<section class="dog-collection" id="dogs">


    <div class="collection-heading">

        <p>AVAILABLE COMPANIONS</p>

        <h2>Meet Dogs Waiting For A Home</h2>

        <span>
            Every dog has a unique story, a loving heart,
            and a family waiting to be found.
        </span>

    </div>




    <!-- DOG CARDS -->


    <div class="dog-grid">



        <!-- Bella -->

        <div class="dog-card">


            <div class="dog-image">

                <img src="bella.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="dog-info">

                <h3>Bella</h3>

                <p>
                    American Pit Bull • 3 Years
                </p>


                <div class="dog-tags">

                    <small>
                        ♀ Female
                    </small>

                    <small>
                        ✓ Vaccinated
                    </small>

                </div>


                <a href="bella.php">
                    View Profile
                </a>


            </div>


        </div>





        <!-- Bruno -->


        <div class="dog-card">


            <div class="dog-image">

                <img src="bruno.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="dog-info">

                <h3>Bruno</h3>

                <p>
                    Shih Tzu • 2 Years
                </p>


                <div class="dog-tags">

                    <small>
                        ♂ Male
                    </small>

                    <small>
                        ✓ Healthy
                    </small>

                </div>


                <a href="bruno.php">
                    View Profile
                </a>


            </div>


        </div>





        <!-- Nova -->


        <div class="dog-card">


            <div class="dog-image">

                <img src="nova.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="dog-info">

                <h3>Nova</h3>

                <p>
                    Indie • 9 weeks
                </p>


                <div class="dog-tags">

                    <small>
                        ♂ Male
                    </small>

                    <small>
                        ♥ Friendly
                    </small>

                </div>


                <a href="nova.php">
                    View Profile
                </a>


            </div>


        </div>





        <!-- Buddy -->


        <div class="dog-card">


            <div class="dog-image">

                <img src="buddy.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="dog-info">

                <h3>Buddy</h3>

                <p>
                    Indie mix • 1.5 Years
                </p>


                <div class="dog-tags">

                    <small>
                        ♀ Female
                    </small>

                    <small>
                        ♥ Playful
                    </small>

                </div>


                <a href="buddy.php">
                    View Profile
                </a>


            </div>


        </div>

        
        <!-- Max -->


        <div class="dog-card">


            <div class="dog-image">

                <img src="max.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="dog-info">

                <h3>Max</h3>

                <p>
                    Rottweiler • 3 Years
                </p>


                <div class="dog-tags">

                    <small>
                        ♂ Male
                    </small>

                    <small>
                        ♥ Calm
                    </small>

                </div>


                <a href="max.php">
                    View Profile
                </a>


            </div>


        </div>


        
        <!--Leo  -->


        <div class="dog-card">


            <div class="dog-image">

                <img src="leo.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="dog-info">

                <h3>Leo</h3>

                <p>
                    Pit Bull mix • 4 Years
                </p>


                <div class="dog-tags">

                    <small>
                        ♀ Female
                    </small>

                    <small>
                        ♥ Energetic
                    </small>

                </div>


                <a href="leo.php">
                    View Profile
                </a>


            </div>


        </div>


        
        <!-- Jack -->


        <div class="dog-card">


            <div class="dog-image">

                <img src="jack.jpeg" >

                <span>
                    Available
                </span>

            </div>



            <div class="dog-info">

                <h3>Jack</h3>

                <p>
                    Catahoula Leopard Dog • 2.5 Years
                </p>


                <div class="dog-tags">

                    <small>
                        ♂ Male
                    </small>

                    <small>
                        ✓ Healthy
                    </small>

                </div>


                <a href="Jack.php">
                    View Profile
                </a>


            </div>


        </div>


        
        <!-- Julie -->


        <div class="dog-card">


            <div class="dog-image">

                <img src="julie.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="dog-info">

                <h3>Julie</h3>

                <p>
                    Tibetan Mastiff mix • 4 Years
                </p>


                <div class="dog-tags">

                    <small>
                        ♀ Female
                    </small>

                    <small>
                        ♥ Active
                    </small>

                </div>


                <a href="julie.php">
                    View Profile
                </a>


            </div>


        </div>


        
        <!-- Snowy -->


        <div class="dog-card">


            <div class="dog-image">

                <img src="snowy.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="dog-info">

                <h3>Snowy</h3>

                <p>
                    Border Collie • 4 Years
                </p>


                <div class="dog-tags">

                    <small>
                        ♀ Female
                    </small>

                    <small>
                        ♥ Curious
                    </small>

                </div>


                <a href="snowy.php">
                    View Profile
                </a>


            </div>


        </div>


        
        <!-- Simba -->


        <div class="dog-card">


            <div class="dog-image">

                <img src="simba.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="dog-info">

                <h3>Simba</h3>

                <p>
                    Sighthound • 4.5 Years
                </p>


                <div class="dog-tags">

                    <small>
                        ♂ Male
                    </small>

                    <small>
                        ♥ Smart
                    </small>

                </div>


                <a href="simba.php">
                    View Profile
                </a>


            </div>


        </div>



        
        <!-- Rose -->


        <div class="dog-card">


            <div class="dog-image">

                <img src="rose.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="dog-info">

                <h3>Rose</h3>

                <p>
                    Chihuahua mix • 11 weeks
                </p>


                <div class="dog-tags">

                    <small>
                        ♀ Female
                    </small>

                    <small>
                        ♥ Gentle
                    </small>

                </div>


                <a href="rose.php">
                    View Profile
                </a>


            </div>


        </div>



        
        <!-- Charlie -->


        <div class="dog-card">


            <div class="dog-image">

                <img src="charlie.jpeg" alt="Max">

                <span>
                    Available
                </span>

            </div>



            <div class="dog-info">

                <h3>Charlie</h3>

                <p>
                    Labrador Retriever • 1.5 Years
                </p>


                <div class="dog-tags">

                    <small>
                        ♂ Male
                    </small>

                    <small>
                        ♥ Quiet
                    </small>

                </div>


                <a href="charlie.php">
                    View Profile
                </a>


            </div>


        </div>



        <!-- Pepper -->


        <div class="dog-card">


            <div class="dog-image">

                <img src="pepper.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="dog-info">

                <h3>Pepper</h3>

                <p>
                    Chihuahua • 9 weeks
                </p>


                <div class="dog-tags">

                    <small>
                        ♀ Female
                    </small>

                    <small>
                        ♥ Loving
                    </small>

                </div>


                <a href="pepper.php">
                    View Profile
                </a>


            </div>


        </div>

        <!-- Nala -->


        <div class="dog-card">


            <div class="dog-image">

                <img src="nala.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="dog-info">

                <h3>Nala</h3>

                <p>
                    Indie • 5 years
                </p>


                <div class="dog-tags">

                    <small>
                        ♂ Male
                    </small>

                    <small>
                        ♥ Kind
                    </small>

                </div>


                <a href="nala.php">
                    View Profile
                </a>


            </div>


        </div>

        <!-- Ivy -->


        <div class="dog-card">


            <div class="dog-image">

                <img src="ivy.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="dog-info">

                <h3>Ivy</h3>

                <p>
                    Labrador Retriever • 3 years
                </p>


                <div class="dog-tags">

                    <small>
                        ♀ Female
                    </small>

                    <small>
                        ♥ Protective
                    </small>

                </div>


                <a href="ivy.php">
                    View Profile
                </a>


            </div>


        </div>


        <!-- roxy -->


        <div class="dog-card">


            <div class="dog-image">

                <img src="roxy.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="dog-info">

                <h3>Roxy</h3>

                <p>
                     German Shepherd • 3 years
                </p>


                <div class="dog-tags">

                    <small>
                        ♂ Male
                    </small>

                    <small>
                        ♥ Brave
                    </small>

                </div>


                <a href="roxy.php">
                    View Profile
                </a>


            </div>


        </div>


        <!-- ============================================
             DOGS ADDED BY NGOs (from the database)
             Generated automatically — nothing above this
             comment was changed.
        ============================================ -->

        <?php while ($dog = $db_dogs->fetch_assoc()) { ?>

        <div class="dog-card">

            <div class="dog-image">

                <img src="<?php echo htmlspecialchars($dog['image']); ?>" alt="<?php echo htmlspecialchars($dog['name']); ?>">

                <span>
                    <?php echo htmlspecialchars($dog['status']); ?>
                </span>

            </div>

            <div class="dog-info">

                <h3><?php echo htmlspecialchars($dog['name']); ?></h3>

                <p>
                    <?php echo htmlspecialchars($dog['breed']); ?> • <?php echo htmlspecialchars($dog['age']); ?>
                </p>

                <div class="dog-tags">

                    <small>
                        📍 <?php echo htmlspecialchars($dog['location']); ?>
                    </small>

                    <small>
                        ✓ <?php echo htmlspecialchars($dog['status']); ?>
                    </small>

                </div>

                <a href="pet_details.php?id=<?php echo $dog['id']; ?>">
                    View Profile
                </a>

            </div>

        </div>

        <?php } ?>


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