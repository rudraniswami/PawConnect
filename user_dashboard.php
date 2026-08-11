<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PawConnect Dashboard</title>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="user_dashboard.css">

</head>

<body>


<!-- ================= SIDEBAR ================= -->

<div class="sidebar">

    <div class="logo">

        <div class="logo-icon">
            <i class="fa-solid fa-paw"></i>
        </div>

        <div>
            <h2>PawConnect</h2>
            <span>Animal Rescue & Adoption</span>
        </div>

    </div>


    <div class="menu-title">
        MAIN MENU
    </div>


    <a href="#" class="menu active">

        <i class="fa-solid fa-house"></i>

        <span>Dashboard</span>

    </a>


    <a href="about.php" class="menu">

        <i class="fa-solid fa-circle-info"></i>

        <span>About Us</span>

    </a>


    <a href="adoption_details.php" class="menu">

        <i class="fa-solid fa-heart"></i>

        <span>Adoption Requests</span>

    </a>


    <a href="mission.php" class="menu">

        <i class="fa-solid fa-bullseye"></i>

        <span> Our Mission</span>

    </a>


    <a href="contact.php" class="menu">

        <i class="fa-solid fa-envelope"></i>

        <span>Contact Us</span>

    </a>


    <div class="menu-title">
        ACCOUNT
    </div>


    <a href="my_profile.php" class="menu">

        <i class="fa-regular fa-user"></i>

        <span>My Profile</span>

    </a>

    <a href="logout.php" class="menu logout">

        <i class="fa-solid fa-right-from-bracket"></i>

        <span>Logout</span>

    </a>


    <div class="sidebar-bottom">

        <i class="fa-solid fa-heart"></i>

        <p>
            Every paw deserves<br>
            a forever home. 🐾
        </p>

    </div>

</div>


<!-- ================= MAIN ================= -->

<div class="main">


    <!-- TOPBAR -->

    <div class="topbar">

        <div>

            <p class="small-title">
                PAWCONNECT DASHBOARD
            </p>

            <h1>
                Welcome back, 
                <?php echo htmlspecialchars($_SESSION['user_name']); ?>! 👋
            </h1>

        </div>


        <div class="top-right">

            <div class="notification">

                <i class="fa-regular fa-bell"></i>

                <span>2</span>

            </div>


            <div class="profile">

                <div class="profile-icon">

                    <i class="fa-regular fa-user"></i>

                </div>

                <div>

                    <h4>
                        <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                    </h4>

                    <p>
                        Pet Lover
                    </p>

                </div>

                <i class="fa-solid fa-chevron-down arrow"></i>

            </div>

        </div>

    </div>


    <!-- WELCOME CARD -->

    <div class="welcome-card">

        <div class="welcome-content">

            <span class="welcome-tag">
                <i class="fa-solid fa-heart"></i>
                MAKING A DIFFERENCE
            </span>

            <h2>
                Together, We Give<br>
                Them a Second Chance.
            </h2>

            <p>
                Explore rescued animals, track adoption requests,
                and help create a safe and loving future for every animal.
            </p>

            <button class="primary-btn">

                <i class="fa-solid fa-paw"></i>

                Explore Animals

            </button>

        </div>


        <div class="welcome-paws">

            <i class="fa-solid fa-paw paw-one"></i>

            <i class="fa-solid fa-paw paw-two"></i>

            <i class="fa-solid fa-paw paw-three"></i>

            <i class="fa-solid fa-heart heart-one"></i>

        </div>

    </div>


    <!-- STATISTICS -->

    <div class="section-heading">

        <div>

            <h2>Your PawConnect Overview</h2>

            <p>
                Your journey towards making a difference.
            </p>

        </div>

    </div>


    <div class="stats">


        <div class="stat-card">

            <div class="stat-icon green">

                <i class="fa-solid fa-paw"></i>

            </div>

            <div>

                <h3>24</h3>

                <p>Rescued Animals</p>

            </div>

            <span class="stat-arrow">
                <i class="fa-solid fa-arrow-up"></i>
            </span>

        </div>


        <div class="stat-card">

            <div class="stat-icon gold">

                <i class="fa-solid fa-heart"></i>

            </div>

            <div>

                <h3>08</h3>

                <p>Adoption Requests</p>

            </div>

            <span class="stat-arrow">
                <i class="fa-solid fa-arrow-up"></i>
            </span>

        </div>


        <div class="stat-card">

            <div class="stat-icon blue">

                <i class="fa-solid fa-house"></i>

            </div>

            <div>

                <h3>05</h3>

                <p>Successful Adoptions</p>

            </div>

            <span class="stat-arrow">
                <i class="fa-solid fa-arrow-up"></i>
            </span>

        </div>


        <div class="stat-card">

            <div class="stat-icon red">

                <i class="fa-solid fa-shield-heart"></i>

            </div>

            <div>

                <h3>12</h3>

                <p>Animals Helped</p>

            </div>

            <span class="stat-arrow">
                <i class="fa-solid fa-arrow-up"></i>
            </span>

        </div>


    </div>


    <!-- LOWER SECTION -->

    <div class="lower-section">


        <!-- QUICK ACTIONS -->

        <div class="quick-card">

            <div class="card-title">

                <div>

                    <h2>Quick Actions</h2>

                    <p>
                        Start making an impact.
                    </p>

                </div>

                <i class="fa-solid fa-bolt"></i>

            </div>


            <div class="actions">


                <div class="action">

                    <div class="action-icon">

                        <i class="fa-solid fa-paw"></i>

                    </div>

                    <div>

                        <h4>Explore Animals</h4>

                        <p>
                            Find rescued pets
                        </p>

                    </div>

                    <i class="fa-solid fa-arrow-right"></i>

                </div>


                <div class="action">

                    <div class="action-icon">

                        <i class="fa-solid fa-heart"></i>

                    </div>

                    <div>

                        <h4>Adoption Request</h4>

                        <p>
                            Start your adoption journey
                        </p>

                    </div>

                    <i class="fa-solid fa-arrow-right"></i>

                </div>


                <div class="action">

                    <div class="action-icon">

                        <i class="fa-solid fa-notes-medical"></i>

                    </div>

                    <div>

                        <h4>Health Passport</h4>

                        <p>
                            View medical records
                        </p>

                    </div>

                    <i class="fa-solid fa-arrow-right"></i>

                </div>


            </div>

        </div>


        <!-- RECENT ACTIVITY -->

        <div class="activity-card">

            <div class="card-title">

                <div>

                    <h2>Recent Activity</h2>

                    <p>
                        Your latest updates.
                    </p>

                </div>

                <i class="fa-regular fa-clock"></i>

            </div>


            <div class="activity">

                <div class="activity-icon">

                    <i class="fa-solid fa-heart"></i>

                </div>

                <div>

                    <h4>Adoption Request Submitted</h4>

                    <p>
                        Bruno's adoption request is under review.
                    </p>

                    <span>
                        2 hours ago
                    </span>

                </div>

            </div>


            <div class="activity">

                <div class="activity-icon">

                    <i class="fa-solid fa-syringe"></i>

                </div>

                <div>

                    <h4>Health Record Updated</h4>

                    <p>
                        Vaccination information was updated.
                    </p>

                    <span>
                        Yesterday
                    </span>

                </div>

            </div>


            <div class="activity">

                <div class="activity-icon">

                    <i class="fa-solid fa-house"></i>

                </div>

                <div>

                    <h4>New Animal Added</h4>

                    <p>
                        A rescued pet has been added.
                    </p>

                    <span>
                        2 days ago
                    </span>

                </div>

            </div>


        </div>

    </div>


    <!-- FOOTER -->

    <div class="footer">

        <p>
            © 2026 PawConnect. Every paw deserves a forever home. 🐾
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