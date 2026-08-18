<?php

session_start();
include "db.php";

/* ================================
   CHECK ANIMAL ID
================================ */

if (!isset($_GET['id'])) {
    die("No animal selected.");
}

$animal_id = intval($_GET['id']);


/* ================================
   GET ANIMAL
================================ */

$stmt = $conn->prepare("SELECT * FROM animals WHERE id = ?");

if (!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("i", $animal_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Animal not found. ID = " . $animal_id);
}

$pet = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>
<?php echo htmlspecialchars($pet['name']); ?> | PawConnect
</title>

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="stylesheet"
      href="passport.css">

</head>


<body>


<!-- ================================
     NAVBAR
================================ -->
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

</div><!-- ================================
     PAW PASSPORT
================================ -->

<section class="passport-section">


    <div class="passport-heading">

        <p>
            PAWCONNECT
        </p>

        <h1>
            Digital Paw Passport
        </h1>

        <span>
            Every paw has a story worth knowing.
        </span>

    </div>



    <div class="passport">


        <!-- LEFT -->

        <div class="passport-left">


            <div class="passport-photo">

                <img src="<?php echo htmlspecialchars($pet['image']); ?>"
                     alt="<?php echo htmlspecialchars($pet['name']); ?>">


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

                    PC-<?php echo strtoupper(
                        htmlspecialchars($pet['name'])
                    ); ?>-<?php echo str_pad(
                        $pet['id'],
                        3,
                        '0',
                        STR_PAD_LEFT
                    ); ?>

                </strong>

            </div>

        </div>



        <!-- RIGHT -->

        <div class="passport-right">


            <div class="passport-top">

                <div>

                    <p>
                        MEET YOUR COMPANION
                    </p>

                    <h2>
                        <?php echo htmlspecialchars($pet['name']); ?>
                    </h2>

                    <h3>
                        <?php echo htmlspecialchars($pet['breed']); ?>
                    </h3>

                </div>


                <div class="paw-symbol">

                    <i class="fa-solid fa-paw"></i>

                </div>

            </div>



            <!-- DETAILS -->

            <div class="passport-details">


                <div class="detail">

                    <small>
                        AGE
                    </small>

                    <strong>
                        <?php echo htmlspecialchars($pet['age']); ?>
                    </strong>

                </div>


                <div class="detail">

                    <small>
                        GENDER
                    </small>

                    <strong>
                        <?php echo htmlspecialchars($pet['gender'] ?? 'Not specified'); ?>
                    </strong>

                </div>


                <div class="detail">

                    <small>
                        TYPE
                    </small>

                    <strong>
                        <?php echo htmlspecialchars($pet['type']); ?>
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
                    ABOUT
                </p>


                <div class="tags">

                    <span>
                        ♥ Friendly
                    </span>

                    <span>
                        ♥ Loving
                    </span>

                    <span>
                        ♥ Caring
                    </span>

                    <span>
                        ♥ Companion
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



<!-- ================================
     PET STORY
================================ -->

<section class="about-section">


    <div class="about-heading">

        <p>
            THEIR STORY
        </p>


        <h2>

            Get to know
            <?php echo htmlspecialchars($pet['name']); ?>

        </h2>

    </div>



    <div class="about-content">


        <p>

            <?php echo nl2br(
                htmlspecialchars($pet['description'] ?? 'No description available.')
            ); ?>

        </p>


        <div class="care-info">


            <div>

                <i class="fa-solid fa-heart"></i>

                <span>
                    Loving companion
                </span>

            </div>


            <div>

                <i class="fa-solid fa-paw"></i>

                <span>

                    <?php echo htmlspecialchars($pet['type']); ?>

                    looking for a home

                </span>

            </div>


            <div>

                <i class="fa-solid fa-house"></i>

                <span>
                    Looking for a forever family
                </span>

            </div>

        </div>

    </div>

</section>



<!-- ================================
     ADOPTION CTA
================================ -->

<section class="adoption-cta">


    <div>

        <p>

            <?php echo strtoupper(
                htmlspecialchars($pet['name'])
            ); ?>

            IS WAITING

        </p>


        <h2>
            Could you be their forever family?
        </h2>

    </div>


    <!-- IMPORTANT -->

    <a href="adopt.php?animal_id=<?php echo $pet['id']; ?>">

        Adopt <?php echo htmlspecialchars($pet['name']); ?>

        <i class="fa-solid fa-arrow-right"></i>

    </a>


</section>



<!-- ================================
     FOOTER
================================ -->

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

                <a href="#">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>

                <a href="#">
                    <i class="fa-brands fa-instagram"></i>
                </a>

                <a href="#">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>

                <a href="#">
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

            <a href="adopt.php?animal_id=<?php echo $pet['id']; ?>">
                Adoption
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