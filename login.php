<?php

session_start();

include("db.php");

if(isset($_POST['login']))
{
    $email = $_POST['email'];
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
            echo "Invalid Password";
        }
    }
    else
    {
        echo "Invalid Email";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>pawconnect login</title>
<link rel="stylesheet" href="login.css">
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
            <span><i class="fa-solid fa-paw"></i></span>
        </div>

        <p>
            Sign in to continue your journey of giving rescued animals a safe,
            loving, and forever home.
        </p>

        <!-- <img src="logindc.jpeg" class="pet"> -->

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

        <!-- form -->
         <form action="login.php" method="POST">

        <label>Email Address</label>

        <div class="input-box">
            <i class="fa-regular fa-envelope"></i>
            <input type="email" name="email" placeholder="Enter your email">
        </div>

        <label>Password</label>

        <div class="input-box">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="Enter your password">
            <i class="fa-regular fa-eye-slash"></i>
        </div>

        <a href="#" class="forgot">Forgot Password?</a>

        <button type="submit" name="login" class="login-button">
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
    onclick="window.location.href='register.php'">

    <i class="fa-regular fa-user"></i>
    Create New Account

</button>
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