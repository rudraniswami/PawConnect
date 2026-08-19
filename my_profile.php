<?php

session_start();

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();

}

include "db.php";


$user_id = (int)$_SESSION['user_id'];


/* ==========================================
   GET USER PROFILE
========================================== */

$sql = "SELECT * FROM users WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Database error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $user_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


if (!$user) {

    die("User not found.");

}


$user_name = $user['name'];


/* ==========================================
   CONTACT REPLIES COUNT
========================================== */

$reply_count = 0;

$stmt = mysqli_prepare(
    $conn,
    "SELECT COUNT(*) AS total
     FROM contact_messages
     WHERE user_id = ?
     AND reply IS NOT NULL
     AND reply != ''"
);

if ($stmt) {

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $user_id
    );

    mysqli_stmt_execute($stmt);

    $reply_result =
        mysqli_stmt_get_result($stmt);

    $reply_data =
        mysqli_fetch_assoc($reply_result);

    $reply_count =
        (int)($reply_data['total'] ?? 0);

    mysqli_stmt_close($stmt);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>My Profile - PawConnect</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet"
          href="my_profile.css">

</head>


<body>


<!-- ================= SIDEBAR ================= -->

<div class="sidebar">


    <div class="logo">

        <div class="logo-icon">

            <i class="fa-solid fa-paw"></i>

        </div>


        <div>

            <h2>
                PawConnect
            </h2>

            <span>
                Animal Rescue & Adoption
            </span>

        </div>

    </div>



    <div class="menu-title">
        MAIN MENU
    </div>



    <a href="user_dashboard.php"
       class="menu">

        <i class="fa-solid fa-house"></i>

        <span>
            Dashboard
        </span>

    </a>



    <a href="home.php"
       class="menu">

        <i class="fa-solid fa-home"></i>

        <span>
            Home
        </span>

    </a>



    <a href="animals.php"
       class="menu">

        <i class="fa-solid fa-paw"></i>

        <span>
            Browse Animals
        </span>

    </a>



    <a href="my_requests.php"
       class="menu">

        <i class="fa-solid fa-heart"></i>

        <span>
            My Adoption Requests
        </span>

    </a>



    <!-- ================= MY MESSAGES ================= -->

    <a href="my_messages.php"
       class="menu">

        <i class="fa-regular fa-message"></i>

        <span>
            My Messages
        </span>


        <?php if ($reply_count > 0) { ?>

            <span class="message-count">

                <?php echo $reply_count; ?>

            </span>

        <?php } ?>

    </a>



    <div class="menu-title">
        ACCOUNT
    </div>



    <a href="my_profile.php"
       class="menu active">

        <i class="fa-regular fa-user"></i>

        <span>
            My Profile
        </span>

    </a>



    <a href="logout.php"
       class="menu logout">

        <i class="fa-solid fa-right-from-bracket"></i>

        <span>
            Logout
        </span>

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


    <!-- ================= TOPBAR ================= -->

    <div class="topbar">


        <div>

            <p class="small-title">
                PAWCONNECT ACCOUNT
            </p>

            <h1>
                My Profile
            </h1>

        </div>



        <div class="top-right">


            <!-- NOTIFICATION -->

            <div class="notification">

                <i class="fa-regular fa-bell"></i>


                <?php if ($reply_count > 0) { ?>

                    <span>
                        <?php echo $reply_count; ?>
                    </span>

                <?php } ?>

            </div>



            <!-- PROFILE -->

            <div class="profile">


                <div class="profile-icon">

                    <i class="fa-regular fa-user"></i>

                </div>


                <div>

                    <h4>

                        <?php

                        echo htmlspecialchars(
                            $user_name
                        );

                        ?>

                    </h4>


                    <p>
                        Pet Lover
                    </p>

                </div>


                <i class="fa-solid fa-chevron-down arrow"></i>

            </div>


        </div>


    </div>



    <!-- ================= SUCCESS MESSAGE ================= -->

    <?php if (isset($_GET['success'])): ?>

        <div class="success-message">

            <i class="fa-solid fa-circle-check"></i>

            Profile updated successfully!

        </div>

    <?php endif; ?>



    <!-- ================= PROFILE HEADER ================= -->

    <div class="profile-header">


        <div class="profile-avatar">

            <i class="fa-solid fa-user"></i>

        </div>



        <div class="profile-intro">


            <span class="profile-tag">

                <i class="fa-solid fa-paw"></i>

                PAWCONNECT MEMBER

            </span>


            <h2>

                Hello,
                <?php echo htmlspecialchars($user_name); ?>! 🐾

            </h2>


            <p>

                Manage your personal information and keep your PawConnect
                profile up to date.

            </p>


        </div>


    </div>



    <!-- ================= PROFILE CONTENT ================= -->

    <div class="profile-layout">


        <!-- ================= PERSONAL INFORMATION ================= -->

        <div class="profile-card">


            <div class="card-heading">


                <div class="heading-icon">

                    <i class="fa-regular fa-user"></i>

                </div>


                <div>

                    <h2>
                        Personal Information
                    </h2>

                    <p>
                        Update your personal details.
                    </p>

                </div>


            </div>



            <form
                action="update_profile.php"
                method="POST"
            >


                <!-- NAME -->

                <div class="form-group">

                    <label>

                        <i class="fa-regular fa-user"></i>

                        Name

                    </label>


                    <input
                        type="text"
                        name="name"
                        value="<?php
                        echo htmlspecialchars(
                            $user['name'] ?? ''
                        );
                        ?>"
                        placeholder="Enter your name"
                        required
                    >

                </div>



                <!-- EMAIL -->

                <div class="form-group">

                    <label>

                        <i class="fa-regular fa-envelope"></i>

                        Email Address

                    </label>


                    <input
                        type="email"
                        name="email"
                        value="<?php
                        echo htmlspecialchars(
                            $user['email'] ?? ''
                        );
                        ?>"
                        placeholder="Enter your email address"
                        required
                    >

                </div>



                <!-- PHONE -->

                <div class="form-group">

                    <label>

                        <i class="fa-solid fa-phone"></i>

                        Phone Number

                    </label>


                    <input
                        type="text"
                        name="phone"
                        value="<?php
                        echo htmlspecialchars(
                            $user['phone'] ?? ''
                        );
                        ?>"
                        placeholder="Enter your phone number"
                        maxlength="10"
                    >

                </div>



                <!-- ADDRESS -->

                <div class="form-group">

                    <label>

                        <i class="fa-solid fa-location-dot"></i>

                        Address

                    </label>


                    <textarea
                        name="address"
                        rows="3"
                        placeholder="Enter your address"
                    ><?php
                    echo htmlspecialchars(
                        $user['address'] ?? ''
                    );
                    ?></textarea>

                </div>



                <!-- CITY + STATE -->

                <div class="two-column">


                    <div class="form-group">

                        <label>

                            <i class="fa-solid fa-city"></i>

                            City

                        </label>


                        <input
                            type="text"
                            name="city"
                            value="<?php
                            echo htmlspecialchars(
                                $user['city'] ?? ''
                            );
                            ?>"
                            placeholder="Enter city"
                        >

                    </div>



                    <div class="form-group">

                        <label>

                            <i class="fa-solid fa-map"></i>

                            State

                        </label>


                        <input
                            type="text"
                            name="state"
                            value="<?php
                            echo htmlspecialchars(
                                $user['state'] ?? ''
                            );
                            ?>"
                            placeholder="Enter state"
                        >

                    </div>


                </div>



                <!-- PINCODE -->

                <div class="form-group">

                    <label>

                        <i class="fa-solid fa-location-crosshairs"></i>

                        Pincode

                    </label>


                    <input
                        type="text"
                        name="pincode"
                        value="<?php
                        echo htmlspecialchars(
                            $user['pincode'] ?? ''
                        );
                        ?>"
                        placeholder="Enter pincode"
                        maxlength="6"
                    >

                </div>



                <!-- BUTTONS -->

                <div class="form-actions">


                    <button
                        type="submit"
                        class="save-btn"
                    >

                        <i class="fa-solid fa-check"></i>

                        Save Changes

                    </button>


                </div>


            </form>


        </div>



        <!-- ================= RIGHT SIDE ================= -->

        <div class="profile-side">


            <!-- ACCOUNT CARD -->

            <div class="account-card">


                <div class="side-icon">

                    <i class="fa-solid fa-shield-heart"></i>

                </div>


                <h2>
                    Your PawConnect Account
                </h2>


                <p>

                    Your profile helps us connect you with rescued animals
                    and manage your adoption journey.

                </p>



                <!-- ACCOUNT TYPE -->

                <div class="account-item">

                    <i class="fa-solid fa-heart"></i>


                    <div>

                        <strong>
                            Pet Lover
                        </strong>

                        <span>
                            Account Type
                        </span>

                    </div>

                </div>



                <!-- ACCOUNT STATUS -->

                <div class="account-item">

                    <i class="fa-solid fa-paw"></i>


                    <div>

                        <strong>
                            Active
                        </strong>

                        <span>
                            Account Status
                        </span>

                    </div>

                </div>



                <!-- MEMBER SINCE -->

                <div class="account-item">

                    <i class="fa-solid fa-calendar"></i>


                    <div>

                        <strong>

                            <?php

                            if (!empty($user['created_at'])) {

                                echo date(
                                    "d M Y",
                                    strtotime(
                                        $user['created_at']
                                    )
                                );

                            } else {

                                echo "Not Available";

                            }

                            ?>

                        </strong>


                        <span>
                            Member Since
                        </span>

                    </div>


                </div>


            </div>



            <!-- SECURITY CARD -->

            <div class="security-card">


                <div class="security-icon">

                    <i class="fa-solid fa-lock"></i>

                </div>


                <div>

                    <h3>
                        Keep your account safe
                    </h3>

                    <p>
                        Never share your password with anyone.
                    </p>

                </div>


            </div>


        </div>


    </div>



    <!-- ================= FOOTER ================= -->

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