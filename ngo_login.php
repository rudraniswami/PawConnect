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

        // Compare typed password with the hashed one saved in the database
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<title>NGO Login - PawConnect</title>
<!-- <link rel="stylesheet" href="ngo.css"> -->
 <style>
 *{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Times New Roman', Times, serif;
}

html,
body{
    min-height:100%;
}

body{
    background:#FFFDF7;
    color:#123C2A;
}


/* =========================
   NAVBAR
========================= */

.main-nav{
    width:100%;
    min-height:80px;

    position:sticky;
    top:0;
    z-index:999;

    background:#123C2A;

    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:0 40px;

    gap:20px;

    box-shadow:0 4px 15px rgba(0,0,0,.12);
}


/* =========================
   LOGO
========================= */

.main-nav-logo{
    display:flex;
    align-items:center;

    gap:12px;

    flex-shrink:0;
}

.main-nav-logo img{
    width:65px;
    height:65px;

    border-radius:50%;

    object-fit:cover;
}

.main-nav-logo h2{
    color:#FFFDF7;

    font-size:28px;

    letter-spacing:1px;
}


/* =========================
   NAV MENU
========================= */

.main-nav-menu{
    display:flex;
    align-items:center;
    justify-content:center;

    gap:25px;

    flex-wrap:wrap;
}

.main-nav-menu > a{
    color:#FFFDF7;

    text-decoration:none;

    font-size:16px;

    font-weight:bold;

    transition:.3s ease;
}

.main-nav-menu > a:hover{
    color:#C6A15B;
}


/* =========================
   DROPDOWN
========================= */

.main-nav-dropdown{
    position:relative;
}

.main-nav-dropdown > a{
    display:flex;
    align-items:center;

    gap:7px;

    padding:10px 14px;

    border-radius:25px;

    color:#FFFDF7;

    text-decoration:none;

    font-size:16px;

    font-weight:bold;

    transition:.3s ease;
}

.main-nav-dropdown > a:hover{
    background:rgba(255,255,255,.08);
}

.main-nav-dropdown-content{
    position:absolute;

    top:52px;
    left:50%;

    transform:translateX(-50%) translateY(10px);

    width:620px;

    padding:22px;

    background:#FFFDF7;

    border-radius:16px;

    box-shadow:0 12px 28px rgba(0,0,0,.18);

    display:flex;

    justify-content:space-between;

    gap:20px;

    opacity:0;

    visibility:hidden;

    transition:.3s ease;
}

.main-nav-dropdown:hover .main-nav-dropdown-content{
    opacity:1;

    visibility:visible;

    transform:translateX(-50%) translateY(0);
}


/* =========================
   DROPDOWN COLUMNS
========================= */

.main-nav-column{
    width:30%;

    display:flex;

    flex-direction:column;
}

.main-nav-column h3{
    color:#123C2A;

    font-size:18px;

    margin-bottom:12px;

    padding-bottom:8px;

    border-bottom:2px solid #C6A15B;
}

.main-nav-column a{
    color:#444;

    text-decoration:none;

    margin:7px 0;

    font-size:15px;

    font-weight:normal;

    transition:.3s ease;
}

.main-nav-column a:hover{
    color:#C6A15B;

    padding-left:5px;
}


/* =========================
   LOGIN / LOGOUT BUTTON
========================= */

.login-btn{
    display:inline-flex;

    align-items:center;
    justify-content:center;

    text-decoration:none;

    color:#FFFDF7;

    background:#C6A15B;

    padding:10px 23px;

    border-radius:30px;

    font-weight:bold;

    transition:.3s ease;

    flex-shrink:0;
}

.login-btn:hover{
    background:#A88344;

    transform:translateY(-2px);
}


/* =========================
   LOGIN AREA
========================= */

.auth-wrapper{
    min-height:calc(100vh - 80px);

    display:flex;

    justify-content:center;
    align-items:center;

    padding:70px 20px;

    background:
        radial-gradient(
            circle at top left,
            rgba(198,161,91,.12),
            transparent 30%
        ),
        #FFFDF7;
}


/* =========================
   LOGIN BOX
========================= */

.auth-box{
    width:100%;

    max-width:480px;

    background:#FFFFFF;

    padding:45px 42px;

    border-radius:30px;

    border:1px solid #eee8dc;

    box-shadow:
        0 20px 50px rgba(18,60,42,.12);

    text-align:left;

    position:relative;

    overflow:hidden;
}

.auth-box::before{
    content:"";

    position:absolute;

    top:0;
    left:0;
    right:0;

    height:6px;

    background:#C6A15B;
}


/* =========================
   HEADING
========================= */

.auth-box h2{
    text-align:center;

    color:#123C2A;

    font-size:42px;

    margin-bottom:8px;
}

.auth-sub{
    text-align:center;

    color:#777;

    font-size:17px;

    margin-bottom:32px;
}


/* =========================
   ERROR MESSAGE
========================= */

.error-msg{
    background:#FBE2E4;

    color:#9B2835;

    border:1px solid #E8B5BA;

    padding:12px 15px;

    border-radius:12px;

    text-align:center;

    font-size:15px;

    margin-bottom:22px;
}


/* =========================
   FORM
========================= */

.form-group{
    margin-bottom:22px;
}

.form-group label{
    display:block;

    color:#123C2A;

    font-size:16px;

    font-weight:bold;

    margin-bottom:8px;
}

.form-group input{
    width:100%;

    padding:14px 16px;

    border:1px solid #ddd5c8;

    border-radius:13px;

    background:#FFFDF7;

    color:#333;

    font-size:16px;

    outline:none;

    transition:.3s ease;
}

.form-group input:focus{
    border-color:#C6A15B;

    background:#fff;

    box-shadow:
        0 0 0 3px rgba(198,161,91,.13);
}


/* =========================
   LOGIN BUTTON
========================= */

.auth-btn{
    width:100%;

    border:none;

    background:#123C2A;

    color:#FFFDF7;

    padding:15px 25px;

    border-radius:30px;

    font-size:18px;

    font-weight:bold;

    cursor:pointer;

    transition:.35s ease;

    margin-top:5px;
}

.auth-btn:hover{
    background:#1D6747;

    transform:translateY(-3px);

    box-shadow:
        0 12px 25px rgba(18,60,42,.20);
}


/* =========================
   REGISTER LINK
========================= */

.auth-switch{
    text-align:center;

    margin-top:25px;

    color:#777;

    font-size:15px;

    line-height:1.6;
}

.auth-switch a{
    color:#C6A15B;

    text-decoration:none;

    font-weight:bold;

    transition:.3s ease;
}

.auth-switch a:hover{
    color:#123C2A;

    text-decoration:underline;
}


/* =========================
   RESPONSIVE NAVBAR
========================= */

@media(max-width:1000px){

    .main-nav{
        padding:10px 25px;
    }

    .main-nav-menu{
        gap:15px;
    }

}


/* =========================
   TABLET
========================= */

@media(max-width:800px){

    .main-nav{
        flex-wrap:wrap;

        justify-content:center;

        padding:15px 20px;
    }

    .main-nav-logo{
        width:100%;

        justify-content:center;
    }

    .main-nav-menu{
        order:2;

        width:100%;

        gap:15px;
    }

    .login-btn{
        order:3;
    }

    .main-nav-dropdown-content{
        width:90vw;

        max-width:620px;
    }

    .auth-wrapper{
        padding:50px 20px;
    }
}


/* =========================
   MOBILE
========================= */

@media(max-width:600px){

    .main-nav-logo img{
        width:55px;
        height:55px;
    }

    .main-nav-logo h2{
        font-size:24px;
    }

    .main-nav-menu{
        gap:10px;
    }

    .main-nav-menu > a,
    .main-nav-dropdown > a{
        font-size:13px;
    }

    .login-btn{
        padding:9px 18px;

        font-size:14px;
    }

    .auth-wrapper{
        min-height:calc(100vh - 130px);

        padding:40px 15px;
    }

    .auth-box{
        padding:38px 25px;

        border-radius:25px;
    }

    .auth-box h2{
        font-size:36px;
    }

    .auth-sub{
        font-size:16px;
    }
}


/* =========================
   SMALL MOBILE
========================= */

@media(max-width:450px){

    .main-nav-dropdown-content{
        width:95vw;

        padding:18px;

        gap:10px;
    }

    .main-nav-column h3{
        font-size:16px;
    }

    .main-nav-column a{
        font-size:13px;
    }

    .auth-box{
        padding:32px 20px;
    }

    .auth-box h2{
        font-size:32px;
    }

    .form-group input{
        padding:13px 14px;
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
        <p class="auth-sub">Log in to manage your animals</p>

        <?php if ($error != "") { ?>
            <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
        <?php } ?>

        <form method="POST" action="ngo_login.php">

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="auth-btn">Login</button>

        </form>

        <div class="auth-switch">
            Don't have an account? <a href="ngo_register.php">Register your NGO</a>
        </div>
    </div>
</div>

</body>
</html>