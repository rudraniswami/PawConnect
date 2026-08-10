<?php

session_start();

if (!isset($_SESSION['ngo_id'])) {

    header("location: ngo_login.php");
    exit();

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PawConnect | NGO Dashboard</title>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="ngo_dashboard.css">

</head>


<body>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<div class="sidebar">


    <!-- LOGO -->

    <div class="logo">

        <div class="logo-icon">

            <i class="fa-solid fa-paw"></i>

        </div>

        <div>

            <h2>PawConnect</h2>

            <span>NGO Partner</span>

        </div>

    </div>


    <!-- MAIN MENU -->

    <div class="menu-title">
        MAIN MENU
    </div>


    <a href="ngo_dashboard.php" class="menu active">

        <i class="fa-solid fa-house"></i>

        <span>Dashboard</span>

    </a>


    <a href="ngo_animals.php" class="menu">

        <i class="fa-solid fa-paw"></i>

        <span>Rescued Animals</span>

    </a>


    <a href="ngo_adoptions.php" class="menu">

        <i class="fa-solid fa-heart"></i>

        <span>Adoption Requests</span>

    </a>


    <a href="add_animal.php" class="menu">

        <i class="fa-solid fa-plus"></i>

        <span>Add Animal</span>

    </a>


    <!-- ACCOUNT -->

    <div class="menu-title">
        ACCOUNT
    </div>


    <a href="ngo_profile.php" class="menu">

        <i class="fa-regular fa-building"></i>

        <span>NGO Profile</span>

    </a>


    <a href="ngo_logout.php" class="menu logout">

        <i class="fa-solid fa-right-from-bracket"></i>

        <span>Logout</span>

    </a>


    <!-- SIDEBAR MESSAGE -->

    <div class="sidebar-bottom">

        <i class="fa-solid fa-heart"></i>

        <p>
            Every rescue<br>
            creates hope. 🐾
        </p>

    </div>

</div>



<!-- =====================================================
     MAIN
===================================================== -->

<div class="main">


    <!-- =================================================
         TOPBAR
    ================================================== -->

    <div class="topbar">


        <div>

            <p class="small-title">
                PAWCONNECT NGO PORTAL
            </p>


            <h1>

                Welcome back,
                <?php
                echo htmlspecialchars($_SESSION['ngo_name']);
                ?>
                👋

            </h1>

        </div>


        <div class="top-right">


            <!-- Notification -->

            <div class="notification">

                <i class="fa-regular fa-bell"></i>

                <span>2</span>

            </div>


            <!-- Profile -->

            <div class="profile">

                <div class="profile-icon">

                    <i class="fa-regular fa-building"></i>

                </div>


                <div>

                    <h4>

                        <?php
                        echo htmlspecialchars($_SESSION['ngo_name']);
                        ?>

                    </h4>

                    <p>
                        NGO Partner
                    </p>

                </div>

            </div>

        </div>

    </div>



    <!-- =================================================
         WELCOME CARD
    ================================================== -->

    <div class="welcome-card">


        <div class="welcome-content">


            <span class="welcome-tag">

                <i class="fa-solid fa-heart"></i>

                NGO PARTNER

            </span>


            <h2>

                Every rescue<br>
                begins with hope.

            </h2>


            <p>

                Manage your rescued animals and help
                connect them with loving forever homes.

            </p>


            <a href="add_animal.php"
               class="primary-btn">

                <i class="fa-solid fa-plus"></i>

                Add Rescued Animal

            </a>


        </div>


        <!-- DECORATION -->

        <div class="welcome-paws">

            <i class="fa-solid fa-paw paw-one"></i>

            <i class="fa-solid fa-paw paw-two"></i>

            <i class="fa-solid fa-heart heart-one"></i>

        </div>

    </div>



    <!-- =================================================
         OVERVIEW
===================================================== -->

    <div class="section-heading">

        <div>

            <h2>
                NGO Overview
            </h2>

            <p>
                A quick look at your rescue activities.
            </p>

        </div>

    </div>



    <!-- =================================================
         STATISTICS
===================================================== -->

    <div class="stats">


        <!-- RESCUED -->

        <div class="stat-card">

            <div class="stat-icon green">

                <i class="fa-solid fa-paw"></i>

            </div>

            <div>

                <h3>24</h3>

                <p>
                    Rescued Animals
                </p>

            </div>

        </div>


        <!-- REQUESTS -->

        <div class="stat-card">

            <div class="stat-icon gold">

                <i class="fa-solid fa-heart"></i>

            </div>

            <div>

                <h3>08</h3>

                <p>
                    Adoption Requests
                </p>

            </div>

        </div>


        <!-- ADOPTED -->

        <div class="stat-card">

            <div class="stat-icon blue">

                <i class="fa-solid fa-house"></i>

            </div>

            <div>

                <h3>05</h3>

                <p>
                    Animals Adopted
                </p>

            </div>

        </div>

    </div>



    <!-- =================================================
         CONTENT
===================================================== -->

    <div class="dashboard-content">


        <!-- =================================================
             ADOPTION REQUESTS
        ================================================== -->

        <div class="dashboard-card">


            <div class="card-heading">

                <div>

                    <h2>
                        Recent Adoption Requests
                    </h2>

                    <p>
                        Requests waiting for your review.
                    </p>

                </div>


                <a href="ngo_adoptions.php">
                    View All
                </a>

            </div>


            <!-- REQUEST 1 -->

            <div class="request">

                <div class="request-icon">

                    <i class="fa-solid fa-heart"></i>

                </div>


                <div class="request-info">

                    <h4>
                        Bruno
                    </h4>

                    <p>
                        Adoption request from Aarav
                    </p>

                    <span>
                        2 hours ago
                    </span>

                </div>


                <span class="pending">
                    Pending
                </span>

            </div>


            <!-- REQUEST 2 -->

            <div class="request">

                <div class="request-icon">

                    <i class="fa-solid fa-heart"></i>

                </div>


                <div class="request-info">

                    <h4>
                        Bella
                    </h4>

                    <p>
                        Adoption request from Ananya
                    </p>

                    <span>
                        Yesterday
                    </span>

                </div>


                <span class="pending">
                    Pending
                </span>

            </div>


            <!-- REQUEST 3 -->

            <div class="request">

                <div class="request-icon">

                    <i class="fa-solid fa-heart"></i>

                </div>


                <div class="request-info">

                    <h4>
                        Milo
                    </h4>

                    <p>
                        Adoption request from Riya
                    </p>

                    <span>
                        2 days ago
                    </span>

                </div>


                <span class="approved">
                    Approved
                </span>

            </div>

        </div>



        <!-- =================================================
             RECENT ANIMALS
        ================================================== -->

        <div class="dashboard-card">


            <div class="card-heading">

                <div>

                    <h2>
                        Recently Added
                    </h2>

                    <p>
                        Animals recently registered by your NGO.
                    </p>

                </div>


                <a href="ngo_animals.php">
                    View All
                </a>

            </div>



            <!-- ANIMAL 1 -->

            <div class="animal-row">

                <div class="animal-image">

                    <i class="fa-solid fa-dog"></i>

                </div>


                <div>

                    <h4>
                        Bruno
                    </h4>

                    <p>
                        Labrador • 2 years
                    </p>

                </div>


                <span class="available">
                    Available
                </span>

            </div>



            <!-- ANIMAL 2 -->

            <div class="animal-row">

                <div class="animal-image">

                    <i class="fa-solid fa-cat"></i>

                </div>


                <div>

                    <h4>
                        Luna
                    </h4>

                    <p>
                        Indie Cat • 1 year
                    </p>

                </div>


                <span class="available">
                    Available
                </span>

            </div>



            <!-- ANIMAL 3 -->

            <div class="animal-row">

                <div class="animal-image">

                    <i class="fa-solid fa-dog"></i>

                </div>


                <div>

                    <h4>
                        Max
                    </h4>

                    <p>
                        Indie Dog • 3 years
                    </p>

                </div>


                <span class="adopted">
                    Adopted
                </span>

            </div>


        </div>

    </div>



    <!-- =================================================
         SIMPLE NGO MESSAGE
===================================================== -->

    <div class="ngo-message">


        <div class="message-icon">

            <i class="fa-solid fa-hand-holding-heart"></i>

        </div>


        <div>

            <h2>
                Thank you for being part of PawConnect.
            </h2>

            <p>
                Together, we can give rescued animals
                the care and forever homes they deserve.
            </p>

        </div>


    </div>



    <!-- =================================================
         FOOTER
===================================================== -->

    <div class="footer">

        <p>
            © 2026 PawConnect.
            Every paw deserves a forever home. 🐾
        </p>


        <div>

            <span>Privacy</span>

            <span>Terms</span>

            <span>Help</span>

        </div>

    </div>


</div>


</body>

</html>