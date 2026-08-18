<?php

include("db.php");

$error = "";

if(isset($_POST['register']))
{
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $phone    = trim($_POST['phone']);
    $address  = trim($_POST['address']);
    $city     = trim($_POST['city']);
    $state    = trim($_POST['state']);
    $pincode  = trim($_POST['pincode']);
    $password = $_POST['password'];


    /* CHECK IF EMAIL ALREADY EXISTS */

    $check = mysqli_prepare(
        $conn,
        "SELECT id FROM users WHERE email = ?"
    );

    mysqli_stmt_bind_param(
        $check,
        "s",
        $email
    );

    mysqli_stmt_execute($check);

    $check_result = mysqli_stmt_get_result($check);


    if(mysqli_num_rows($check_result) > 0)
    {
        $error = "An account with this email already exists.";
    }
    else
    {
        /* HASH PASSWORD */

        $hashed_password = password_hash(
            $password,
            PASSWORD_DEFAULT
        );


        /* INSERT USER */

        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO users
            (name, email, password, phone, address, city, state, pincode)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );


        mysqli_stmt_bind_param(
            $stmt,
            "ssssssss",
            $name,
            $email,
            $hashed_password,
            $phone,
            $address,
            $city,
            $state,
            $pincode
        );


        if(mysqli_stmt_execute($stmt))
        {
            header("Location: login.php");
            exit();
        }
        else
        {
            $error = "Account could not be created. Please try again.";
        }


        mysqli_stmt_close($stmt);
    }

    mysqli_stmt_close($check);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <title>PawConnect Register</title>

    <link rel="stylesheet"
          href="user_register.css">

    <style>

    /* ================= ERROR ================= */

    .register-error {
        width: 100%;

        display: flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        background: #fff0f1;

        color: #9B2835;

        border: 1px solid #edc4c8;

        padding: 12px 15px;

        border-radius: 10px;

        font-size: 14px;

        font-weight: bold;

        text-align: center;

        margin-bottom: 20px;

        box-sizing: border-box;
    }


    /* ================= BACK HOME ================= */

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

    </style>

</head>


<body>


<div class="register-page">

    <div class="register-container">


        <!-- ================= LEFT SIDE ================= -->

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



        <!-- ================= RIGHT SIDE ================= -->

        <div class="register-right">


            <h2>
                Create Your Account
            </h2>


            <div class="heading-line"></div>


            <p class="sub-text">

                Join PawConnect and start making a difference today.

            </p>


            <?php if($error != "") { ?>

                <div class="register-error">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <?php echo htmlspecialchars($error); ?>

                </div>

            <?php } ?>



            <form
                action="user_register.php"
                method="POST"
            >


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



                <!-- PHONE -->

                <label>Phone Number</label>

                <div class="input-box">

                    <i class="fa-solid fa-phone"></i>

                    <input
                        type="tel"
                        name="phone"
                        placeholder="Enter your phone number"
                        maxlength="10"
                        required
                    >

                </div>



                <!-- ADDRESS -->

                <label>Address</label>

                <div class="input-box">

                    <i class="fa-solid fa-location-dot"></i>

                    <input
                        type="text"
                        name="address"
                        placeholder="Enter your address"
                        required
                    >

                </div>



                <!-- CITY -->

                <label>City</label>

                <div class="input-box">

                    <i class="fa-solid fa-city"></i>

                    <input
                        type="text"
                        name="city"
                        placeholder="Enter your city"
                        required
                    >

                </div>



                <!-- STATE -->

                <label>State</label>

                <div class="input-box">

                    <i class="fa-solid fa-map"></i>

                    <input
                        type="text"
                        name="state"
                        placeholder="Enter your state"
                        required
                    >

                </div>



                <!-- PINCODE -->

                <label>Pincode</label>

                <div class="input-box">

                    <i class="fa-solid fa-location-crosshairs"></i>

                    <input
                        type="text"
                        name="pincode"
                        placeholder="Enter your pincode"
                        maxlength="6"
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

                    <input
                        type="checkbox"
                        required
                    >

                    <p>

                        I agree to the PawConnect

                        <a href="#">
                            Terms & Conditions
                        </a>

                    </p>

                </div>



                <!-- REGISTER BUTTON -->

                <button
                    type="submit"
                    name="register"
                    class="register-button"
                >

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



            <!-- BACK HOME -->

            <a
                href="home.php"
                class="back-home"
            >

                <i class="fa-solid fa-arrow-left"></i>

                Back to Home

            </a>



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