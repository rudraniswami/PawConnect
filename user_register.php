<?php

include("db.php");

if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(name, email, password)
            VALUES('$name', '$email', '$password')";

    if(mysqli_query($conn, $sql))
    {
        header("location: login.php");
        exit();
    }
    else
    {
        echo "Account Not Created";
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

    <title>PawConnect Register</title>

    <link rel="stylesheet" href="user_register.css">

</head>

<body>

<div class="register-page">

    <div class="register-container">

        <!-- LEFT SIDE -->

        <div class="register-left">

            <div class="paw-icon">
                <i class="fa-solid fa-paw"></i>
            </div>

            <h1>
                Join <span>PawConnect</span>
            </h1>

            <div class="line">
                <span>
                    <i class="fa-solid fa-heart"></i>
                </span>
            </div>

            <p>
                Create your PawConnect account and become part of a
                community helping rescued animals find safe,
                loving, and forever homes.
            </p>

            <div class="benefits">

                <div class="benefit-box">

                    <i class="fa-solid fa-paw"></i>

                    <div>
                        <h4>Explore</h4>
                        <p>Rescued Animals</p>
                    </div>

                </div>

                <div class="benefit-box">

                    <i class="fa-solid fa-heart"></i>

                    <div>
                        <h4>Adopt</h4>
                        <p>Give Them A Home</p>
                    </div>

                </div>

                <div class="benefit-box">

                    <i class="fa-solid fa-shield-heart"></i>

                    <div>
                        <h4>Connect</h4>
                        <p>Trusted NGOs</p>
                    </div>

                </div>

            </div>

        </div>


        <!-- RIGHT SIDE -->

        <div class="register-right">

            <h2>Create Your Account</h2>

            <div class="heading-line"></div>

            <p class="sub-text">
                Join PawConnect and start making a difference today.
            </p>


            <form action="user_register.php" method="POST">

                <!-- NAME -->

                <label>Full Name</label>

                <div class="input-box">

                    <i class="fa-regular fa-user"></i>

                    <input
                        type="text"
                        name="name"
                        placeholder="Enter your full name"
                        required
                    >

                </div>


                <!-- EMAIL -->

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


                <!-- PASSWORD -->

                <label>Password</label>

                <div class="input-box">

                    <i class="fa-solid fa-lock"></i>

                    <input
                        type="password"
                        name="password"
                        placeholder="Create a password"
                        required
                    >

                    <i class="fa-regular fa-eye-slash"></i>

                </div>


                <!-- TERMS -->

                <div class="terms">

                    <input type="checkbox" required>

                    <p>
                        I agree to the PawConnect
                        <a href="#">Terms & Conditions</a>
                    </p>

                </div>


                <!-- REGISTER BUTTON -->

                <button
                    type="submit"
                    name="register"
                    class="register-button">

                    <i class="fa-solid fa-paw"></i>

                    Create Account

                </button>

            </form>


            <!-- LOGIN -->

            <div class="already">

                <p>
                    Already have an account?
                </p>

                <a href="login.php">
                    Login here
                </a>

            </div>


            <!-- NOTE -->

            <div class="note">

                <div class="circle">

                    <i class="fa-regular fa-heart"></i>

                </div>

                <p>
                    Every new member helps bring rescued animals
                    one step closer to a forever home. 🐾❤️
                </p>

            </div>

        </div>

    </div>

</div>

</body>
</html>