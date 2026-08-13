<?php

session_start();

include "db.php";


/* ==========================================
   SEND CONTACT MESSAGE
========================================== */

if (isset($_POST['send_message'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);


    /* BASIC VALIDATION */

    if (
        $name == "" ||
        $email == "" ||
        $phone == "" ||
        $subject == "" ||
        $message == ""
    ) {

        $error = "Please fill in all fields.";

    } else {

        /* PREPARED STATEMENT */

        $stmt = $conn->prepare("
            INSERT INTO contact_messages
            (name, email, phone, subject, message)
            VALUES (?, ?, ?, ?, ?)
        ");


        if (!$stmt) {

            $error = "Database error: " . $conn->error;

        } else {

            $stmt->bind_param(
                "sssss",
                $name,
                $email,
                $phone,
                $subject,
                $message
            );


            if ($stmt->execute()) {

                $stmt->close();

                /* NO JAVASCRIPT */

                header("Location: contact_success.php");
                exit();

            } else {

                $error = "Unable to send your message. Please try again.";

            }


            $stmt->close();

        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<title>Contact | PawConnect</title>

<link rel="stylesheet"
      href="contact.css">

</head>


<body>


<!-- ================= NAVBAR ================= -->

<div class="nav">


    <!-- LOGO -->

    <div class="logo">

        <img src="logo.jpeg"
             alt="PawConnect Logo">

        <h2>
            PawConnect
        </h2>

    </div>



    <!-- CENTER MENU -->

    <div class="menu">


        <a href="home.php">
            HOME
        </a>


        <a href="about.php">
            ABOUT US
        </a>



        <!-- EXPLORE -->

        <div class="dropdown">


            <a href="#">

                EXPLORE

                <i class="fa-solid fa-chevron-down"></i>

            </a>



            <div class="dropdown-content">


                <!-- ABOUT -->

                <div class="column">

                    <h3>
                        About
                    </h3>

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



                <!-- ADOPTION -->

                <div class="column">

                    <h3>
                        Adoption
                    </h3>

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



                <!-- LOGIN -->

                <div class="column">

                    <h3>
                        Login
                    </h3>

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



        <!-- ANIMALS -->

        <a href="animals.php">
            ANIMALS
        </a>



        <!-- DASHBOARD -->

        <a href="<?php

            echo isset($_SESSION['user_id'])
                ? 'user_dashboard.php'
                : 'login.php';

        ?>">

            DASHBOARD

        </a>


    </div>



    <!-- RIGHT SIDE -->

    <div class="main-nav-action">


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



<!-- ================= HERO ================= -->

<section class="contact-hero">


    <!-- LEFT -->

    <div class="left">


        <span class="small-title">

            🐾 GET IN TOUCH

        </span>



        <h1>

            We'd Love <br>

            to Hear From <span>You!</span>

        </h1>



        <p>

            Have a question, suggestion or want to adopt a rescued pet?

            Our team is always ready to help you.

        </p>



        <div class="info-box">


            <!-- PHONE -->

            <div class="box">


                <i class="fa-solid fa-phone"></i>


                <div>

                    <h3>
                        Call Us
                    </h3>

                    <p>
                        +91 9876543210
                    </p>

                </div>


            </div>



            <!-- EMAIL -->

            <div class="box">


                <i class="fa-solid fa-envelope"></i>


                <div>

                    <h3>
                        Email
                    </h3>

                    <p>
                        support@pawconnect.com
                    </p>

                </div>


            </div>



            <!-- LOCATION -->

            <div class="box">


                <i class="fa-solid fa-location-dot"></i>


                <div>

                    <h3>
                        Visit Us
                    </h3>

                    <p>
                        Pune, Maharashtra
                    </p>

                </div>


            </div>



            <!-- HOURS -->

            <div class="box">


                <i class="fa-solid fa-clock"></i>


                <div>

                    <h3>
                        Working Hours
                    </h3>

                    <p>
                        Mon - Sat | 9 AM - 7 PM
                    </p>

                </div>


            </div>


        </div>


    </div>



    <!-- ================= RIGHT SIDE ================= -->

    <div class="right">


        <div class="form-card">


            <h2>

                <i class="fa-regular fa-message"></i>

                Send Us A Message

            </h2>



            <!-- ERROR MESSAGE -->

            <?php if (isset($error)) { ?>

                <div style="
                    background:#f8d7da;
                    color:#721c24;
                    padding:12px 15px;
                    border-radius:10px;
                    margin-bottom:20px;
                    font-size:15px;
                ">

                    <?php echo htmlspecialchars($error); ?>

                </div>

            <?php } ?>



            <!-- FORM -->

            <form method="POST"
                  action="contact.php">


                <div class="row">


                    <input type="text"
                           name="name"
                           placeholder="Your Name"
                           required>


                    <input type="email"
                           name="email"
                           placeholder="Your Email"
                           required>


                </div>



                <input type="text"
                       name="phone"
                       placeholder="Phone Number"
                       required>



                <input type="text"
                       name="subject"
                       placeholder="Subject"
                       required>



                <textarea
                    name="message"
                    placeholder="Write Your Message"
                    required></textarea>



                <button type="submit"
                        name="send_message">

                    <i class="fa-regular fa-paper-plane"></i>

                    SEND MESSAGE

                </button>


            </form>


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


                <a href="#"
                   aria-label="Facebook">

                    <i class="fa-brands fa-facebook-f"></i>

                </a>


                <a href="#"
                   aria-label="Instagram">

                    <i class="fa-brands fa-instagram"></i>

                </a>


                <a href="#"
                   aria-label="X">

                    <i class="fa-brands fa-x-twitter"></i>

                </a>


                <a href="#"
                   aria-label="LinkedIn">

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


            <a href="animals.php">
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