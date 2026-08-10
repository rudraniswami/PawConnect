<?php
include "db.php";

// Pull cats added by NGOs through addanimal.php
$stmt = $conn->prepare("SELECT * FROM animals WHERE type = ? ORDER BY created_at DESC");
$type = "Cat";
$stmt->bind_param("s", $type);
$stmt->execute();
$db_cats = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Cats | PawConnect</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<link rel="stylesheet" href="cats.css">

</head>


<body>


<!-- NAVBAR -->

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

            <a href="dashboard.php">Dashboard</a>

            <a href="addanimal.php">Add Animal</a>

        </div>

    </div>

</div>

<a href="adopt.html">ADOPT</a>

<a href="contact.html">CONTACT</a>
    </div>

    <a href="login.php" class="login-btn">LOGIN</a>
</div>




<!-- HERO -->

<section class="cat-hero">

<div class="hero-content">

<p>FIND YOUR FOREVER FRIEND</p>

<h1>
Little Paws,<br>Endless Love.
</h1>


<h3>
Explore caring cats ready to bring comfort,joy<br>and companionship into your life.
</h3>




</div>

</section>

<!-- cat COLLECTION SECTION -->

<section class="cat-collection" id="cats">


    <div class="collection-heading">

        <p>AVAILABLE COMPANIONS</p>

        <h2>Meet Cats Waiting For A Home</h2>

        <span>
            Every cat has a unique story, a quiet soul, and a loving family waiting to welcome them.
        </span>

    </div>




    <!-- CAT CARDS -->


    <div class="cat-grid">



        <!-- Theo -->

        <div class="cat-card">


            <div class="cat-image">

                <img src="theo.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="cat-info">

                <h3>Theo</h3>

                <p>
                    Orange Tabby • 1 Year
                </p>


                <div class="cat-tags">

                    <small>
                        ♀ Female
                    </small>

                    <small>
                        ♥ Friendly
                    </small>

                </div>


                <a href="theo.html">
                    View Profile
                </a>


            </div>


        </div>





        <!-- Lumi -->


        <div class="cat-card">


            <div class="cat-image">

                <img src="lumi.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="cat-info">

                <h3>Lumi</h3>

                <p>
                    Indie Cat • 2 Years
                </p>


                <div class="cat-tags">

                    <small>
                        ♀ Female
                    </small>

                    <small>
                        ♥ Playful
                    </small>

                </div>


                <a href="lumi.html">
                    View Profile
                </a>


            </div>


        </div>





        <!-- Aster -->


        <div class="cat-card">


            <div class="cat-image">

                <img src="aster.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="cat-info">

                <h3>Aster</h3>

                <p>
                    Persian mix • 1.5 years
                </p>


                <div class="cat-tags">

                    <small>
                        ♂ Male
                    </small>

                    <small>
                        ♥ Curious
                    </small>

                </div>


                <a href="aster.html">
                    View Profile
                </a>


            </div>


        </div>





        <!-- Cosmo -->


        <div class="cat-card">


            <div class="cat-image">

                <img src="cosmo.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="cat-info">

                <h3>Cosmo</h3>

                <p>
                    Domestic Shorthair Tabby • 2 Years
                </p>


                <div class="cat-tags">

                    <small>
                        ♂ male
                    </small>

                    <small>
                        ♥ Smart
                    </small>

                </div>


                <a href="cosmo.html">
                    View Profile
                </a>


            </div>


        </div>

        
        <!-- Miso -->


        <div class="cat-card">


            <div class="cat-image">

                <img src="miso.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="cat-info">

                <h3>Miso</h3>

                <p>
                    Domestic Shorthair • 1 Year
                </p>


                <div class="cat-tags">

                    <small>
                        ♂ Male
                    </small>

                    <small>
                        ♥ Calm
                    </small>

                </div>


                <a href="miso.html">
                    View Profile
                </a>


            </div>


        </div>


        
        <!-- sia -->


        <div class="cat-card">


            <div class="cat-image">

                <img src="sia.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="cat-info">

                <h3>Sia</h3>

                <p>
                    Tortoiseshell • 2.5 Years
                </p>


                <div class="cat-tags">

                    <small>
                        ♀ Female
                    </small>

                    <small>
                        ♥ Energetic
                    </small>

                </div>


                <a href="sia.html">
                    View Profile
                </a>


            </div>


        </div>


        
        <!-- Yuki -->


        <div class="cat-card">


            <div class="cat-image">

                <img src="yuki.jpeg" >

                <span>
                    Available
                </span>

            </div>



            <div class="cat-info">

                <h3>Yuki</h3>

                <p>
                    Bicolor Shorthair • 1.5 Years
                </p>


                <div class="cat-tags">

                    <small>
                        ♂ Male
                    </small>

                    <small>
                        ✓ Healthy
                    </small>

                </div>


                <a href="yuki.html">
                    View Profile
                </a>


            </div>


        </div>


        
        <!-- kai -->


        <div class="cat-card">


            <div class="cat-image">

                <img src="kai.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="cat-info">

                <h3>Kai</h3>

                <p>
                    Domestic Shorthair • 8 months
                </p>


                <div class="cat-tags">

                    <small>
                        ♀ Female
                    </small>

                    <small>
                        ♥ Active
                    </small>

                </div>


                <a href="kai.html">
                    View Profile
                </a>


            </div>


        </div>


        
        <!-- cleo -->


        <div class="cat-card">


            <div class="cat-image">

                <img src="cleo.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="cat-info">

                <h3>Cleo</h3>

                <p>
                    Orange Tabby • 1.5 Years
                </p>


                <div class="cat-tags">

                    <small>
                        ♀ Female
                    </small>

                    <small>
                        ♥ Curious
                    </small>

                </div>


                <a href="cleo.html">
                    View Profile
                </a>


            </div>


        </div>


        
        <!-- Amara -->


        <div class="cat-card">


            <div class="cat-image">

                <img src="amara.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="cat-info">

                <h3>Amara</h3>

                <p>
                    Longhair-Silver Tabby • 1.5 Years
                </p>


                <div class="cat-tags">

                    <small>
                        ♂ Male
                    </small>

                    <small>
                        ♥ Smart
                    </small>

                </div>


                <a href="amara.html">
                    View Profile
                </a>


            </div>


        </div>



        
        <!-- nia -->


        <div class="cat-card">


            <div class="cat-image">

                <img src="nia.jpeg">

                <span>
                    Available
                </span>

            </div>



            <div class="cat-info">

                <h3>Nia</h3>

                <p>
                    Ragdoll mix • 11 weeks
                </p>


                <div class="cat-tags">

                    <small>
                        ♀ Female
                    </small>

                    <small>
                        ♥ Gentle
                    </small>

                </div>


                <a href="nia.html">
                    View Profile
                </a>


            </div>


        </div>



        
        <!-- Lyra -->


        <div class="cat-card">


            <div class="cat-image">

                <img src="lyra.jpeg" alt="Max">

                <span>
                    Available
                </span>

            </div>



            <div class="cat-info">

                <h3>Lyra</h3>

                <p>
                    Persian • 1 Years
                </p>


                <div class="cat-tags">

                    <small>
                        ♀ Female
                    </small>

                    <small>
                        ♥ Quiet
                    </small>

                </div>


                <a href="lyra.html">
                    View Profile
                </a>


            </div>


        </div>


        <!-- ============================================
             CATS ADDED BY NGOs (from the database)
             Generated automatically — nothing above this
             comment was changed.
        ============================================ -->

        <?php while ($cat = $db_cats->fetch_assoc()) { ?>

        <div class="cat-card">

            <div class="cat-image">

                <img src="<?php echo htmlspecialchars($cat['image']); ?>" alt="<?php echo htmlspecialchars($cat['name']); ?>">

                <span>
                    <?php echo htmlspecialchars($cat['status']); ?>
                </span>

            </div>

            <div class="cat-info">

                <h3><?php echo htmlspecialchars($cat['name']); ?></h3>

                <p>
                    <?php echo htmlspecialchars($cat['breed']); ?> • <?php echo htmlspecialchars($cat['age']); ?>
                </p>

                <div class="cat-tags">

                    <small>
                        📍 <?php echo htmlspecialchars($cat['location']); ?>
                    </small>

                    <small>
                        ✓ <?php echo htmlspecialchars($cat['status']); ?>
                    </small>

                </div>

                <a href="pet_details.php?id=<?php echo $cat['id']; ?>">
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