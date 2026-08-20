<?php
include "db.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* =====================================================
   GET CATS ADDED BY NGOs
===================================================== */

$stmt = $conn->prepare("
    SELECT *
    FROM animals
    WHERE type = ?
    ORDER BY created_at DESC
");

$type = "Cat";
$stmt->bind_param("s", $type);
$stmt->execute();

$db_cats = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Cats | PawConnect</title>

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="stylesheet"
      href="cats.css">

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


                <div class="column">

                    <h3>Login</h3>

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


        <a href="animals.php">
            ANIMALS
        </a>


        <a href="<?php
            echo isset($_SESSION['user_id'])
                ? 'user_dashboard.php'
                : 'login.php';
        ?>">
            DASHBOARD
        </a>

    </div>


    <div class="nav-actions">

        <?php if (isset($_SESSION['user_id'])) { ?>

            <a href="logout.php"
               class="login-btn">
                LOGOUT
            </a>

        <?php } else { ?>

            <a href="login.php"
               class="login-btn">
                LOGIN
            </a>

        <?php } ?>

    </div>

</div>



<!-- =====================================================
     HERO
===================================================== -->

<section class="cat-hero">

    <div class="hero-content">

        <p>
            FIND YOUR FOREVER FRIEND
        </p>

        <h1>
            Little Paws,<br>
            Endless Love.
        </h1>

        <h3>
            Explore caring cats ready to bring
            comfort, joy<br>
            and companionship into your life.
        </h3>

    </div>

</section>



<!-- =====================================================
     CAT COLLECTION
===================================================== -->

<section class="cat-collection" id="cats">

    <div class="collection-heading">

        <p>
            AVAILABLE COMPANIONS
        </p>

        <h2>
            Meet Cats Waiting For A Home
        </h2>

        <span>
            Every cat has a unique story, a quiet soul,
            and a loving family waiting to welcome them.
        </span>

    </div>


    <div class="cat-grid">


        <!-- =================================================
             STATIC CATS
        ================================================== -->


        <!-- THEO -->

        <div class="cat-card">

            <div class="cat-image">

                <img src="theo.jpeg" alt="Theo">

                <span>Available</span>

            </div>

            <div class="cat-info">

                <h3>Theo</h3>

                <p>
                    Orange Tabby • 1 Year
                </p>

                <div class="cat-tags">

                    <small>♀ Female</small>

                    <small>♥ Friendly</small>

                </div>

                <a href="theo.php">
                    View Profile
                </a>

            </div>

        </div>



        <!-- LUMI -->

        <div class="cat-card">

            <div class="cat-image">

                <img src="lumi.jpeg" alt="Lumi">

                <span>Available</span>

            </div>

            <div class="cat-info">

                <h3>Lumi</h3>

                <p>
                    Indie Cat • 2 Years
                </p>

                <div class="cat-tags">

                    <small>♀ Female</small>

                    <small>♥ Playful</small>

                </div>

                <a href="lumi.php">
                    View Profile
                </a>

            </div>

        </div>



        <!-- ASTER -->

        <div class="cat-card">

            <div class="cat-image">

                <img src="aster.jpeg" alt="Aster">

                <span>Available</span>

            </div>

            <div class="cat-info">

                <h3>Aster</h3>

                <p>
                    Persian mix • 1.5 Years
                </p>

                <div class="cat-tags">

                    <small>♂ Male</small>

                    <small>♥ Curious</small>

                </div>

                <a href="aster.php">
                    View Profile
                </a>

            </div>

        </div>



        <!-- COSMO -->

        <div class="cat-card">

            <div class="cat-image">

                <img src="cosmo.jpeg" alt="Cosmo">

                <span>Available</span>

            </div>

            <div class="cat-info">

                <h3>Cosmo</h3>

                <p>
                    Domestic Shorthair Tabby • 2 Years
                </p>

                <div class="cat-tags">

                    <small>♂ Male</small>

                    <small>♥ Smart</small>

                </div>

                <a href="cosmo.php">
                    View Profile
                </a>

            </div>

        </div>



        <!-- MISO -->

        <div class="cat-card">

            <div class="cat-image">

                <img src="miso.jpeg" alt="Miso">

                <span>Available</span>

            </div>

            <div class="cat-info">

                <h3>Miso</h3>

                <p>
                    Domestic Shorthair • 1 Year
                </p>

                <div class="cat-tags">

                    <small>♂ Male</small>

                    <small>♥ Calm</small>

                </div>

                <a href="miso.php">
                    View Profile
                </a>

            </div>

        </div>



        <!-- SIA -->

        <div class="cat-card">

            <div class="cat-image">

                <img src="sia.jpeg" alt="Sia">

                <span>Available</span>

            </div>

            <div class="cat-info">

                <h3>Sia</h3>

                <p>
                    Tortoiseshell • 2.5 Years
                </p>

                <div class="cat-tags">

                    <small>♀ Female</small>

                    <small>♥ Energetic</small>

                </div>

                <a href="sia.php">
                    View Profile
                </a>

            </div>

        </div>



        <!-- YUKI -->

        <div class="cat-card">

            <div class="cat-image">

                <img src="yuki.jpeg" alt="Yuki">

                <span>Available</span>

            </div>

            <div class="cat-info">

                <h3>Yuki</h3>

                <p>
                    Bicolor Shorthair • 1.5 Years
                </p>

                <div class="cat-tags">

                    <small>♂ Male</small>

                    <small>✓ Healthy</small>

                </div>

                <a href="yuki.php">
                    View Profile
                </a>

            </div>

        </div>



        <!-- KAI -->

        <div class="cat-card">

            <div class="cat-image">

                <img src="kai.jpeg" alt="Kai">

                <span>Available</span>

            </div>

            <div class="cat-info">

                <h3>Kai</h3>

                <p>
                    Domestic Shorthair • 8 months
                </p>

                <div class="cat-tags">

                    <small>♀ Female</small>

                    <small>♥ Active</small>

                </div>

                <a href="kai.php">
                    View Profile
                </a>

            </div>

        </div>



        <!-- CLEO -->

        <div class="cat-card">

            <div class="cat-image">

                <img src="cleo.jpeg" alt="Cleo">

                <span>Available</span>

            </div>

            <div class="cat-info">

                <h3>Cleo</h3>

                <p>
                    Orange Tabby • 1.5 Years
                </p>

                <div class="cat-tags">

                    <small>♀ Female</small>

                    <small>♥ Curious</small>

                </div>

                <a href="cleo.php">
                    View Profile
                </a>

            </div>

        </div>



        <!-- AMARA -->

        <div class="cat-card">

            <div class="cat-image">

                <img src="amara.jpeg" alt="Amara">

                <span>Available</span>

            </div>

            <div class="cat-info">

                <h3>Amara</h3>

                <p>
                    Longhair-Silver Tabby • 1.5 Years
                </p>

                <div class="cat-tags">

                    <small>♂ Male</small>

                    <small>♥ Smart</small>

                </div>

                <a href="amara.php">
                    View Profile
                </a>

            </div>

        </div>



        <!-- NIA -->

        <div class="cat-card">

            <div class="cat-image">

                <img src="nia.jpeg" alt="Nia">

                <span>Available</span>

            </div>

            <div class="cat-info">

                <h3>Nia</h3>

                <p>
                    Ragdoll mix • 11 weeks
                </p>

                <div class="cat-tags">

                    <small>♀ Female</small>

                    <small>♥ Gentle</small>

                </div>

                <a href="nia.php">
                    View Profile
                </a>

            </div>

        </div>



        <!-- LYRA -->

        <div class="cat-card">

            <div class="cat-image">

                <img src="lyra.jpeg" alt="Lyra">

                <span>Available</span>

            </div>

            <div class="cat-info">

                <h3>Lyra</h3>

                <p>
                    Persian • 1 Year
                </p>

                <div class="cat-tags">

                    <small>♀ Female</small>

                    <small>♥ Quiet</small>

                </div>

                <a href="lyra.php">
                    View Profile
                </a>

            </div>

        </div>



        <!-- =================================================
             NGO ADDED CATS
             IMAGE IS STORED DIRECTLY IN PAWCONNECT FOLDER
        ================================================== -->

        <?php while ($cat = $db_cats->fetch_assoc()) { ?>

            <div class="cat-card">

                <div class="cat-image">

                    <img
                        src="<?php echo htmlspecialchars($cat['image']); ?>"
                        alt="<?php echo htmlspecialchars($cat['name']); ?>"
                    >

                    <span>
                        <?php echo htmlspecialchars($cat['status']); ?>
                    </span>

                </div>


                <div class="cat-info">

                    <h3>
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </h3>


                    <p>

                        <?php
                        echo htmlspecialchars(
                            !empty($cat['breed'])
                                ? $cat['breed']
                                : 'Cat'
                        );
                        ?>

                        •

                        <?php
                        echo htmlspecialchars(
                            !empty($cat['age'])
                                ? $cat['age']
                                : 'Age not specified'
                        );
                        ?>

                    </p>


                    <div class="cat-tags">

                        <small>

                            <?php
                            echo !empty($cat['gender'])
                                ? htmlspecialchars($cat['gender'])
                                : 'Gender not specified';
                            ?>

                        </small>


                        <small>

                            ✓

                            <?php
                            echo !empty($cat['health_status'])
                                ? htmlspecialchars($cat['health_status'])
                                : htmlspecialchars($cat['status']);
                            ?>

                        </small>

                    </div>


                    <a href="pet_details.php?id=<?php echo (int)$cat['id']; ?>">
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



    <div class="footer-bottom">

        <p>
            © 2026 PawConnect • Connecting every paw with care,
            compassion & a place to belong.
        </p>

    </div>

</footer>


</body>
</html>