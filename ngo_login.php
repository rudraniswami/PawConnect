<?php

session_start();

include("db.php");


/* =====================================================
   NGO LOGIN
===================================================== */

$error = "";


if(isset($_POST['login']))
{

    $email = $_POST['email'];
    $password = $_POST['password'];


    /* FIND NGO */

    $sql = "SELECT * FROM ngos WHERE email='$email'";

    $result = mysqli_query($conn, $sql);


    if(!$result)
    {
        die("Query Error: " . mysqli_error($conn));
    }


    /* CHECK NGO */

    if(mysqli_num_rows($result) == 1)
    {

        $ngo = mysqli_fetch_assoc($result);


        /* CHECK PASSWORD */

        if(password_verify($password, $ngo['password']))
        {

            /* CREATE NGO SESSION */

            $_SESSION['ngo_id'] = $ngo['id'];

            $_SESSION['ngo_name'] = $ngo['name'];

            $_SESSION['ngo_email'] = $ngo['email'];


            /* REDIRECT TO NGO DASHBOARD */

            header("Location: ngo_dashboard.php");

            exit();

        }
        else
        {

            $error = "Invalid password.";

        }

    }
    else
    {

        $error = "NGO account not found.";

    }

}

?>


<!DOCTYPE html>

<html lang="en">


<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <title>PawConnect | NGO Login</title>

    <link
        rel="stylesheet"
        href="ngo_login.css"
    >

</head>


<body>


<!-- =====================================================
     LOGIN PAGE
===================================================== -->

<div class="login-page">


    <div class="container">


        <!-- =================================================
             LEFT SIDE
        ================================================== -->

        <div class="left">


            <h1>

                Welcome Back to

                <span>
                    PawConnect
                </span>

            </h1>


            <div class="line">

                <span>

                    <i class="fa-solid fa-paw"></i>

                </span>

            </div>


            <p>

                Sign in to manage rescued animals,
                review adoption requests, and help
                animals find loving forever homes.

            </p>



            <!-- FEATURES -->

            <div class="features">


                <div class="box">

                    <i class="fa-solid fa-paw"></i>

                    <h4>
                        Manage
                    </h4>

                    <p>
                        Rescued Animals
                    </p>

                </div>



                <div class="box">

                    <i class="fa-solid fa-heart"></i>

                    <h4>
                        Review
                    </h4>

                    <p>
                        Adoption Requests
                    </p>

                </div>



                <div class="box">

                    <i class="fa-solid fa-plus-circle"></i>

                    <h4>
                        Add
                    </h4>

                    <p>
                        Rescued Animals
                    </p>

                </div>



                <div class="box">

                    <i class="fa-solid fa-building"></i>

                    <h4>
                        Connect
                    </h4>

                    <p>
                        With PawConnect
                    </p>

                </div>


            </div>


        </div>



        <!-- =================================================
             RIGHT SIDE
        ================================================== -->

        <div class="right">


            <h2>
                NGO Partner Login
            </h2>


            <div class="heading-line"></div>


            <p class="text">

                Log in to your NGO account and continue
                helping rescued animals find a better life.

            </p>



            <!-- ERROR MESSAGE -->

            <?php if($error != "") { ?>

                <div class="error-message">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <?php echo htmlspecialchars($error); ?>

                </div>

            <?php } ?>



            <!-- =================================================
                 LOGIN FORM
            ================================================== -->

            <form
                action="ngo_login.php"
                method="POST"
            >


                <!-- EMAIL -->

                <label>
                    Email Address
                </label>


                <div class="input-box">

                    <i class="fa-regular fa-envelope"></i>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter NGO email"
                        required
                    >

                </div>



                <!-- PASSWORD -->

                <label>
                    Password
                </label>


                <div class="input-box">

                    <i class="fa-solid fa-lock"></i>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >

                </div>



                <!-- LOGIN BUTTON -->

                <button
                    type="submit"
                    name="login"
                    class="login-button"
                >

                    <i class="fa-solid fa-paw"></i>

                    Login as NGO

                </button>


            </form>



            <!-- =================================================
                 NOTE
            ================================================== -->

            <div class="note">


                <div class="circle">

                    <i class="fa-regular fa-heart"></i>

                </div>


                <p>

                    Every rescue brings one animal
                    closer to a safe and loving home. 🐾❤️

                </p>


            </div>


        </div>


    </div>


</div>


</body>

</html>