<?php
session_start();
include "db.php";

// Protect this page: only logged-in NGOs can see it
if (!isset($_SESSION["ngo_id"])) {
    header("Location: ngo_login.php");
    exit();
}

$ngo_id = $_SESSION["ngo_id"];

// Get all animals added by this NGO
$stmt = $conn->prepare("SELECT * FROM animals WHERE ngo_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $ngo_id);
$stmt->execute();
$animals = $stmt->get_result();


// =====================================================
// DASHBOARD STATISTICS
// =====================================================

// Total animals
$count_stmt = $conn->prepare("SELECT COUNT(*) AS total FROM animals WHERE ngo_id = ?");
$count_stmt->bind_param("i", $ngo_id);
$count_stmt->execute();
$count_result = $count_stmt->get_result()->fetch_assoc();
$total_animals = $count_result["total"];


// Available animals
$available_stmt = $conn->prepare("SELECT COUNT(*) AS total FROM animals WHERE ngo_id = ? AND status = 'Available'");
$available_stmt->bind_param("i", $ngo_id);
$available_stmt->execute();
$available_result = $available_stmt->get_result()->fetch_assoc();
$available_animals = $available_result["total"];

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<title>NGO Dashboard - PawConnect</title>

<link rel="stylesheet" href="ngo.css">

</head>

<body>


<!-- =====================================================
     NAVBAR
===================================================== -->

<div class="main-nav">

    <div class="main-nav-logo">

        <img src="logo.jpeg" alt="PawConnect Logo">

        <h2>PawConnect</h2>

    </div>


    <div class="main-nav-menu">

        <a href="home.php">
            HOME
        </a>

        <a href="animals.php">
            ANIMALS
        </a>


        <div class="main-nav-dropdown">

            <a href="#">
                EXPLORE
                <i class="fa-solid fa-chevron-down"></i>
            </a>


            <div class="main-nav-dropdown-content">


                <div class="main-nav-column">

                    <h3>About</h3>

                    <a href="about.php">
                        About Us
                    </a>

                    <a href="mission.php">
                        Mission
                    </a>

                    <a href="contact.php">
                        Contact
                    </a>

                </div>



                <div class="main-nav-column">

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



                <div class="main-nav-column">

                    <h3>NGO</h3>

                   <a href="ngo_login.php">NGO Login</a>

            <a href="ngo_register.php">Register NGO</a>

            <a href="admin_login.php">Admin Login</a>

                </div>


            </div>

        </div>


        <a href="adopt.php">
            ADOPT
        </a>

        <a href="contact.php">
            CONTACT
        </a>

    </div>


    <div class="topbar-links">

        <span style="color:#FFFDF7;">

            Welcome,
            <?php echo htmlspecialchars($_SESSION["ngo_name"]); ?>

        </span>


        <a href="ngo_logout.php" class="logout-btn">
            Logout
        </a>

    </div>

</div>



<!-- =====================================================
     DASHBOARD
===================================================== -->

<div class="dashboard-wrapper">


    <!-- WELCOME -->

    <div class="dashboard-welcome">

        <div class="welcome-content">

            <span class="dashboard-label">
                NGO DASHBOARD
            </span>

            <h1>
                Your Animals
            </h1>

            <p>
                Manage the animals your NGO has listed on
                PawConnect and help them find loving homes.
            </p>

        </div>


        <div class="welcome-icon">

            <i class="fa-solid fa-paw"></i>

        </div>

    </div>



    <!-- =================================================
         STATISTICS
    ================================================= -->

    <div class="dashboard-stats">


        <!-- TOTAL ANIMALS -->

        <div class="stat-card">

            <div class="stat-icon">

                <i class="fa-solid fa-paw"></i>

            </div>

            <div class="stat-content">

                <span>
                    Total Animals
                </span>

                <strong>
                    <?php echo $total_animals; ?>
                </strong>

            </div>

        </div>



        <!-- AVAILABLE ANIMALS -->

        <div class="stat-card">

            <div class="stat-icon">

                <i class="fa-solid fa-heart"></i>

            </div>

            <div class="stat-content">

                <span>
                    Available for Adoption
                </span>

                <strong>
                    <?php echo $available_animals; ?>
                </strong>

            </div>

        </div>



        <!-- NGO ROLE -->

        <div class="stat-card">

            <div class="stat-icon">

                <i class="fa-solid fa-hand-holding-heart"></i>

            </div>

            <div class="stat-content">

                <span>
                    Helping Animals
                </span>

                <strong>
                    <?php echo $total_animals; ?>
                </strong>

            </div>

        </div>


    </div>



    <!-- =================================================
         QUICK ACTIONS
    ================================================= -->

    <div class="section-heading">

        <div>

            <span>
                QUICK ACTIONS
            </span>

            <h2>
                Manage your NGO
            </h2>

        </div>

    </div>


    <div class="quick-actions">


        <!-- ADD ANIMAL -->

        <a href="addanimal.php" class="action-card">

            <div class="action-icon">

                <i class="fa-solid fa-plus"></i>

            </div>

            <div>

                <h3>
                    Add Animal
                </h3>

                <p>
                    Create a new animal listing.
                </p>
            </div>

            <i class="fa-solid fa-arrow-right action-arrow"></i>

        </a>



        <!-- VIEW ANIMALS -->

        <a href="animals.php" class="action-card">

            <div class="action-icon">

                <i class="fa-solid fa-paw"></i>

            </div>

            <div>

                <h3>
                    View Animals
                </h3>

                <p>
                    Explore animals listed on PawConnect.
                </p>

            </div>

            <i class="fa-solid fa-arrow-right action-arrow"></i>

        </a>



        <!-- CARE RESOURCES -->

        <a href="care.php" class="action-card">

            <div class="action-icon">

                <i class="fa-solid fa-hand-holding-heart"></i>

            </div>

            <div>

                <h3>
                    Care Resources
                </h3>

                <p>
                    Helpful guidance for animal care.
                </p>

            </div>

            <i class="fa-solid fa-arrow-right action-arrow"></i>

        </a>


    </div>



    <!-- =================================================
         ANIMAL LIST
    ================================================= -->

    <div class="animal-section">


        <div class="section-heading">

            <div>

                <span>
                    YOUR LISTINGS
                </span>

                <h2>
                    Recently Added Animals
                </h2>

            </div>


            <a href="addanimal.php"
               class="add-animal-btn">

                <i class="fa-solid fa-plus"></i>

                Add Animal

            </a>

        </div>



        <?php if ($animals->num_rows > 0) { ?>


        <div class="animal-table-wrapper">

            <table class="animal-table">


                <thead>

                    <tr>

                        <th>Photo</th>

                        <th>Name</th>

                        <th>Type</th>

                        <th>Breed</th>

                        <th>Age</th>

                        <th>Location</th>

                        <th>Status</th>

                    </tr>

                </thead>


                <tbody>


                <?php while ($animal = $animals->fetch_assoc()) { ?>


                    <tr>

                        <td>

                            <img
                                src="<?php echo htmlspecialchars($animal['image']); ?>"
                                alt="<?php echo htmlspecialchars($animal['name']); ?>">

                        </td>


                        <td>

                            <strong class="animal-name">

                                <?php echo htmlspecialchars($animal['name']); ?>

                            </strong>

                        </td>


                        <td>

                            <?php echo htmlspecialchars($animal['type']); ?>

                        </td>


                        <td>

                            <?php echo htmlspecialchars($animal['breed']); ?>

                        </td>


                        <td>

                            <?php echo htmlspecialchars($animal['age']); ?>

                        </td>


                        <td>

                            <span class="location-text">

                                <i class="fa-solid fa-location-dot"></i>

                                <?php echo htmlspecialchars($animal['location']); ?>

                            </span>

                        </td>


                        <td>

                            <?php if ($animal['status'] == "Available") { ?>

                                <span class="status-tag status-available">

                                    <i class="fa-solid fa-circle-check"></i>

                                    Available

                                </span>

                            <?php } else { ?>

                                <span class="status-tag status-adopted">

                                    <i class="fa-solid fa-house"></i>

                                    Adopted

                                </span>

                            <?php } ?>

                        </td>


                    </tr>


                <?php } ?>


                </tbody>

            </table>

        </div>


        <?php } else { ?>


        <!-- EMPTY STATE -->

        <div class="no-animals">

            <div class="empty-icon">

                <i class="fa-solid fa-paw"></i>

            </div>

            <h3>
                No animals listed yet
            </h3>

            <p>
                Start by adding your first animal to PawConnect.
            </p>

            <a href="addanimal.php"
               class="add-animal-btn">

                <i class="fa-solid fa-plus"></i>

                Add Your First Animal

            </a>

        </div>


        <?php } ?>


    </div>


</div>



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

            <a href="adopt.php">
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