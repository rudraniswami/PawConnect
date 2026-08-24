<?php
session_start();
include "db.php";

$error = "";

// If already logged in, go straight to dashboard
if (isset($_SESSION["ngo_id"])) {
    header("Location: ngo_dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email    = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, name, password FROM ngos WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $ngo = $result->fetch_assoc();

        // Compare typed password with the hashed one saved in database
        if (password_verify($password, $ngo["password"])) {

            $_SESSION["ngo_id"]   = $ngo["id"];
            $_SESSION["ngo_name"] = $ngo["name"];

            header("Location: ngo_dashboard.php");
            exit();

        } else {
            $error = "Incorrect email or password.";
        }

    } else {
        $error = "Incorrect email or password.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<title>NGO Login - PawConnect</title>

<style>

/* =====================================================
   RESET
===================================================== */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    min-height: 100vh;
    background: #FFFDF7;
    color: #123C2A;
    font-family: "Times New Roman", Times, serif;
}


/* =====================================================
   NAVBAR
===================================================== */

.main-nav {
    width: 100%;
    min-height: 80px;

    position: sticky;
    top: 0;
    z-index: 9999;

    background: #123C2A;

    display: flex;
    align-items: center;

    padding: 0 40px;

    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
}


/* =====================================================
   LOGO
===================================================== */

.main-nav-logo {
    display: flex;
    align-items: center;

    gap: 12px;

    flex: 0 0 auto;
}

.main-nav-logo img {
    width: 60px;
    height: 60px;

    border-radius: 50%;

    object-fit: cover;

    display: block;
}

.main-nav-logo h2 {
    color: #FFFDF7;

    font-size: 28px;
    letter-spacing: 1px;

    white-space: nowrap;
}


/* =====================================================
   NAV MENU
===================================================== */

.main-nav-menu {
    display: flex;
    align-items: center;
    justify-content: center;

    gap: 28px;

    margin-left: auto;
    margin-right: auto;

    white-space: nowrap;
}

.main-nav-menu > a {
    color: #FFFDF7;

    text-decoration: none;

    font-size: 15px;
    font-weight: bold;

    padding: 10px 4px;

    transition: 0.3s ease;
}

.main-nav-menu > a:hover {
    color: #C6A15B;
}


/* =====================================================
   DROPDOWN
===================================================== */

.main-nav-dropdown {
    position: relative;
}

.main-nav-dropdown > a {
    display: flex;
    align-items: center;

    gap: 7px;

    padding: 10px 4px;

    color: #FFFDF7;

    text-decoration: none;

    font-size: 15px;
    font-weight: bold;

    transition: 0.3s ease;
}

.main-nav-dropdown > a:hover {
    color: #C6A15B;
}

.main-nav-dropdown > a i {
    font-size: 11px;

    transition: transform 0.3s ease;
}

.main-nav-dropdown:hover > a i {
    transform: rotate(180deg);
}


/* =====================================================
   DROPDOWN BOX
===================================================== */

.main-nav-dropdown-content {
    position: absolute;

    top: calc(100% + 15px);
    left: 50%;

    transform: translateX(-50%) translateY(10px);

    width: 620px;

    padding: 25px;

    background: #FFFDF7;

    border-radius: 18px;

    border: 1px solid #eee5d7;

    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.18);

    display: flex;
    align-items: flex-start;
    justify-content: space-between;

    gap: 25px;

    opacity: 0;
    visibility: hidden;

    transition: 0.3s ease;
}


/* small invisible bridge */

.main-nav-dropdown-content::before {
    content: "";

    position: absolute;

    top: -15px;
    left: 0;

    width: 100%;
    height: 15px;
}


.main-nav-dropdown:hover .main-nav-dropdown-content {
    opacity: 1;
    visibility: visible;

    transform: translateX(-50%) translateY(0);
}


/* =====================================================
   DROPDOWN COLUMNS
===================================================== */

.main-nav-column {
    width: 33.333%;

    display: flex;
    flex-direction: column;

    align-items: flex-start;
}

.main-nav-column h3 {
    width: 100%;

    color: #123C2A;

    font-size: 18px;

    margin-bottom: 10px;
    padding-bottom: 8px;

    border-bottom: 2px solid #C6A15B;
}

.main-nav-column a {
    color: #555;

    text-decoration: none;

    font-size: 15px;

    margin: 6px 0;

    transition: 0.3s ease;
}

.main-nav-column a:hover {
    color: #C6A15B;

    padding-left: 5px;
}


/* =====================================================
   RIGHT NAV BUTTON
===================================================== */

.main-nav > .login-btn {
    flex: 0 0 auto;
}

.login-btn {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-width: 95px;

    padding: 11px 22px;

    border-radius: 30px;

    background: #C6A15B;

    color: #FFFDF7;

    text-decoration: none;

    font-size: 15px;
    font-weight: bold;

    white-space: nowrap;

    transition: 0.3s ease;
}

.login-btn:hover {
    background: #A88344;

    color: #FFFDF7;

    transform: translateY(-2px);
}


/* =====================================================
   LOGIN PAGE BACKGROUND
===================================================== */

.auth-wrapper {
    min-height: calc(100vh - 80px);

    display: flex;

    justify-content: center;
    align-items: center;

    padding: 60px 20px;

    background:
        radial-gradient(
            circle at 10% 15%,
            rgba(198, 161, 91, 0.15),
            transparent 28%
        ),
        radial-gradient(
            circle at 90% 85%,
            rgba(18, 60, 42, 0.08),
            transparent 30%
        ),
        #FFFDF7;
}


/* =====================================================
   LOGIN CARD
===================================================== */

.auth-box {
    position: relative;

    width: 100%;
    max-width: 470px;

    padding: 45px 42px;

    background: #FFFFFF;

    border: 1px solid #eee7dc;

    border-radius: 28px;

    box-shadow:
        0 15px 40px rgba(18, 60, 42, 0.10),
        0 3px 10px rgba(0, 0, 0, 0.04);

    overflow: hidden;
}


/* GOLD TOP LINE */

.auth-box::before {
    content: "";

    position: absolute;

    top: 0;
    left: 0;

    width: 100%;
    height: 6px;

    background: #C6A15B;
}


/* =====================================================
   LOGIN ICON
===================================================== */

.auth-box::after {
    content: "\f508";

    font-family: "Font Awesome 6 Free";

    font-weight: 900;

    position: absolute;

    top: 25px;
    right: 28px;

    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #eef3ec;

    color: #123C2A;

    font-size: 17px;
}


/* =====================================================
   HEADING
===================================================== */

.auth-box h2 {
    color: #123C2A;

    text-align: center;

    font-size: 40px;

    font-weight: bold;

    margin-bottom: 8px;
}

.auth-sub {
    color: #777;

    text-align: center;

    font-size: 16px;

    margin-bottom: 30px;
}


/* =====================================================
   ERROR
===================================================== */

.error-msg {
    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    width: 100%;

    background: #fff0f1;

    color: #9B2835;

    border: 1px solid #edc4c8;

    padding: 12px 15px;

    border-radius: 12px;

    text-align: center;

    font-size: 15px;

    margin: 0 auto 22px auto;

    position: relative;

    box-sizing: border-box;
}


/* =====================================================
   FORM
===================================================== */

.form-group {
    margin-bottom: 21px;
}

.form-group label {
    display: block;

    color: #123C2A;

    font-size: 16px;

    font-weight: bold;

    margin-bottom: 8px;
}


/* INPUT */

.form-group input {
    width: 100%;

    height: 50px;

    padding: 0 16px;

    border: 1px solid #ddd5c8;

    border-radius: 12px;

    background: #FFFDF7;

    color: #333;

    font-family: "Times New Roman", Times, serif;

    font-size: 16px;

    outline: none;

    transition: 0.3s ease;
}

.form-group input::placeholder {
    color: #aaa;
}

.form-group input:hover {
    border-color: #C6A15B;
}

.form-group input:focus {
    background: #FFFFFF;

    border-color: #C6A15B;

    box-shadow:
        0 0 0 3px rgba(198, 161, 91, 0.12);
}


/* =====================================================
   LOGIN BUTTON
===================================================== */

.auth-btn {
    width: 100%;

    height: 52px;

    border: none;

    border-radius: 30px;

    background: #123C2A;

    color: #FFFDF7;

    font-family: "Times New Roman", Times, serif;

    font-size: 18px;

    font-weight: bold;

    cursor: pointer;

    margin-top: 5px;

    transition: 0.3s ease;
}

.auth-btn:hover {
    background: #1D6747;

    transform: translateY(-2px);

    box-shadow:
        0 10px 22px rgba(18, 60, 42, 0.18);
}


/* =====================================================
   REGISTER
===================================================== */

.auth-switch {
    text-align: center;

    margin-top: 25px;

    color: #777;

    font-size: 15px;

    line-height: 1.5;
}

.auth-switch a {
    color: #C6A15B;

    text-decoration: none;

    font-weight: bold;

    transition: 0.3s ease;
}

.auth-switch a:hover {
    color: #123C2A;

    text-decoration: underline;
}



/* =====================================================
   TABLET
===================================================== */

@media (max-width: 1050px) {

    .main-nav {
        padding: 0 25px;
    }

    .main-nav-menu {
        gap: 17px;
    }

    .main-nav-menu > a,
    .main-nav-dropdown > a {
        font-size: 14px;
    }

    .main-nav-logo h2 {
        font-size: 24px;
    }

}


/* =====================================================
   TABLET / SMALL LAPTOP
===================================================== */

@media (max-width: 850px) {

    .main-nav {
        min-height: auto;

        flex-wrap: wrap;

        justify-content: center;

        gap: 10px;

        padding: 12px 20px;
    }

    .main-nav-logo {
        width: 100%;

        justify-content: center;
    }

    .main-nav-menu {
        margin: 0;

        width: 100%;

        justify-content: center;

        flex-wrap: wrap;

        gap: 15px;
    }

    .main-nav > .login-btn {
        margin: 5px auto 0;
    }

    .auth-wrapper {
        min-height: calc(100vh - 150px);

        padding: 50px 20px;
    }

}


/* =====================================================
   MOBILE
===================================================== */

@media (max-width: 600px) {

    .main-nav {
        padding: 12px 15px;
    }

    .main-nav-logo img {
        width: 52px;
        height: 52px;
    }

    .main-nav-logo h2 {
        font-size: 23px;
    }

    .main-nav-menu {
        gap: 8px 13px;
    }

    .main-nav-menu > a,
    .main-nav-dropdown > a {
        font-size: 12px;

        padding: 6px 2px;
    }

    .login-btn {
        min-width: 90px;

        padding: 9px 18px;

        font-size: 13px;
    }


    /* DROPDOWN */

    .main-nav-dropdown-content {
        width: 94vw;

        padding: 18px;

        gap: 12px;
    }

    .main-nav-column h3 {
        font-size: 15px;
    }

    .main-nav-column a {
        font-size: 12px;
    }


    /* LOGIN */

    .auth-wrapper {
        padding: 35px 15px;
    }

    .auth-box {
        padding: 38px 25px;

        border-radius: 24px;
    }

    .auth-box::after {
        display: none;
    }

    .auth-box h2 {
        font-size: 34px;
    }

    .auth-sub {
        font-size: 15px;

        margin-bottom: 25px;
    }

}


/* =====================================================
   SMALL MOBILE
===================================================== */

@media (max-width: 420px) {

    .main-nav-logo h2 {
        font-size: 21px;
    }

    .main-nav-menu {
        gap: 6px 10px;
    }

    .main-nav-menu > a,
    .main-nav-dropdown > a {
        font-size: 11px;
    }

    .auth-box {
        padding: 35px 20px;
    }

    .auth-box h2 {
        font-size: 30px;
    }

    .form-group input {
        height: 48px;

        font-size: 15px;
    }

    .auth-btn {
        height: 50px;

        font-size: 17px;
    }

}

</style>

</head>

<body>

<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<div class="main-nav">

    <div class="main-nav-logo">

        <img src="logo.jpeg" alt="PawConnect Logo">

        <h2>PawConnect</h2>

    </div>


    <div class="main-nav-menu">

        <a href="home.php">
            HOME
        </a>


        <a href="about.php">
            ABOUT US
        </a>


        <div class="main-nav-dropdown">

            <a href="#">
                EXPLORE
                <i class="fa-solid fa-chevron-down"></i>
            </a>


            <div class="main-nav-dropdown-content">


                <!-- ABOUT -->

                <div class="main-nav-column">

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

                <div class="main-nav-column">

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

                <div class="main-nav-column">

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


    <!-- LOGOUT -->

    <?php if (isset($_SESSION['user_id'])) { ?>

        <a href="logout.php" class="login-btn">
            LOGOUT
        </a>

    <?php } ?>


</div>


<div class="auth-wrapper">

    <div class="auth-box">

        <h2>NGO Login</h2>

        <p class="auth-sub">
            Log in to manage your animals
        </p>


        <?php if ($error != "") { ?>

            <div class="error-msg">
                <i class="fa-solid fa-circle-exclamation"></i>

                <?php echo htmlspecialchars($error); ?>
            </div>

        <?php } ?>


        <form method="POST" action="ngo_login.php">

            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    required
                >

            </div>


            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    required
                >

            </div>


            <button type="submit" class="auth-btn">
                Login
            </button>

        </form>


        <div class="auth-switch">

            Don't have an account?

            <a href="ngo_register.php">
                Register your NGO
            </a>

        </div>


        


    </div>

</div>

</body>

</html>