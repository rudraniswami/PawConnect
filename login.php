<?php

session_start();

include("db.php");

$error = "";

if(isset($_POST['login']))
{
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = mysqli_query($conn, $sql);

    if(!$result)
    {
        die("Query Error: " . mysqli_error($conn));
    }

    if(mysqli_num_rows($result) == 1)
    {
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            header("Location: user_dashboard.php");
            exit();
        }
        else
        {
            $error = "Invalid password. Please try again.";
        }
    }
    else
    {
        $error = "Invalid email. Please check your email address.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<title>PawConnect Login</title>

<link rel="stylesheet" href="login.css">

<style>

/* =====================================================
   LOGIN ERROR MESSAGE
===================================================== */

.login-error {
    width: 100%;

    display: flex;
    align-items: center;
    justify-content: center;

    gap: 9px;

    padding: 12px 15px;

    margin: 0 0 20px 0;

    background: #fff0f1;

    color: #9B2835;

    border: 1px solid #edc4c8;

    border-radius: 10px;

    font-size: 14px;

    font-weight: bold;

    text-align: center;

    box-sizing: border-box;
}

.login-error i {
    font-size: 15px;
}


/* =====================================================
   BACK TO HOME
===================================================== */

.back-home {
    display: flex;

    align-items: center;
    justify-content: center;

    gap: 7px;

    margin-top: 18px;

    color: #123C2A;

    text-decoration: none;

    font-size: 14px;

    font-weight: bold;

    transition: 0.3s ease;
}

.back-home:hover {
    color: #C6A15B;

    transform: translateX(-2px);
}

.back-home i {
    font-size: 13px;
}

</style>

</head>

<body>

<!-- login -->

<div class="login-page">

<div class="container">

    <!-- Left Side -->

    <div class="left">

        <h1>
            Welcome Back to
            <span>PawConnect</span>
        </h1>

        <div class="line">
            <span>
                <i class="fa-solid fa-paw"></i>
            </span>
        </div>

        <p>
            Sign in to continue your journey of giving rescued animals a safe,
            loving, and forever home.
        </p>


        <div class="features">

            <div class="box">

                <i class="fa-solid fa-paw"></i>

                <h4>Explore</h4>

                <p>Rescued Animals</p>

            </div>


            <div class="box">

                <i class="fa-solid fa-heart-circle-check"></i>

                <h4>Submit</h4>

                <p>Adoption Requests</p>

            </div>


            <div class="box">

                <i class="fa-regular fa-clipboard"></i>

                <h4>Track</h4>

                <p>Adoption Status</p>

            </div>


            <div class="box">

                <i class="fa-solid fa-shield-heart"></i>

                <h4>Connect</h4>

                <p>Trusted NGOs</p>

            </div>

        </div>

    </div>


    <!-- Right Side -->

    <div class="right">

        <h2>Login to Your Account</h2>

        <div class="heading-line"></div>

        <p class="text">

            Log in to access your PawConnect account and explore,
            adopt, and make a difference.

        </p>


        <!-- ERROR MESSAGE -->

        <?php if($error != "") { ?>

            <div class="login-error">

                <i class="fa-solid fa-circle-exclamation"></i>

                <?php echo htmlspecialchars($error); ?>

            </div>

        <?php } ?>


        <!-- FORM -->

        <form action="login.php" method="POST">


            <label>Email Address</label>

            <div class="input-box">

                <i class="fa-regular fa-envelope"></i>

                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                >

            </div>


            <label>Password</label>

            <div class="input-box">

                <i class="fa-solid fa-lock"></i>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >

                <i class="fa-regular fa-eye-slash"></i>

            </div>


            <a href="#" class="forgot">
                Forgot Password?
            </a>


            <button
                type="submit"
                name="login"
                class="login-button">

                <i class="fa-solid fa-paw"></i>

                Login

            </button>


        </form>


        <div class="or">

            <span></span>

            OR

            <span></span>

        </div>


        <button
            class="create-btn"
            type="button"
            onclick="window.location.href='user_register.php'">

            <i class="fa-regular fa-user"></i>

            Create New Account

        </button>


        <!-- BACK TO HOME -->

        <a href="home.php" class="back-home">

            <i class="fa-solid fa-arrow-left"></i>

            Back to Home

        </a>


        <div class="note">

            <div class="circle">

                <i class="fa-regular fa-heart"></i>

            </div>

            <p>

                Every login brings one rescued animal closer to a forever home.
                🐾❤️

            </p>

        </div>


    </div>

</div>

</div>

</body>

</html>