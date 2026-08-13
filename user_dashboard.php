<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    exit();
}

include "db.php";

$user_id = intval($_SESSION['user_id']);


/* ==========================================
   STATS - THIS USER'S ADOPTION REQUESTS
========================================== */

$stmt = $conn->prepare(
    "SELECT COUNT(*) AS total
     FROM adoption_requests
     WHERE user_id = ?"
);

$stmt->bind_param("i", $user_id);
$stmt->execute();

$my_requests_total =
    $stmt->get_result()->fetch_assoc()['total'];


/* PENDING */

$stmt = $conn->prepare(
    "SELECT COUNT(*) AS total
     FROM adoption_requests
     WHERE user_id = ?
     AND status = 'Pending'"
);

$stmt->bind_param("i", $user_id);
$stmt->execute();

$my_requests_pending =
    $stmt->get_result()->fetch_assoc()['total'];


/* APPROVED + COMPLETED */

$stmt = $conn->prepare(
    "SELECT COUNT(*) AS total
     FROM adoption_requests
     WHERE user_id = ?
     AND (status = 'Approved' OR status = 'Completed')"
);

$stmt->bind_param("i", $user_id);
$stmt->execute();

$my_requests_approved =
    $stmt->get_result()->fetch_assoc()['total'];


/* ==========================================
   COMPLETED ADOPTION
========================================== */

$stmt = $conn->prepare(
    "SELECT
        ar.id,
        ar.status,
        ar.created_at,

        a.name AS animal_name,
        p.name AS old_pet_name

     FROM adoption_requests ar

     LEFT JOIN animals a
        ON ar.animal_id = a.id

     LEFT JOIN pets p
        ON ar.pet_id = p.id

     WHERE ar.user_id = ?
     AND ar.status = 'Completed'

     ORDER BY ar.id DESC

     LIMIT 1"
);

$stmt->bind_param("i", $user_id);
$stmt->execute();

$completed_result = $stmt->get_result();

$completed_adoption =
    $completed_result->fetch_assoc();


/* ==========================================
   SITE-WIDE ANIMAL COUNTS
========================================== */

$animals_count_result =
    $conn->query(
        "SELECT COUNT(*) AS total FROM animals"
    );

$total_animals =
    $animals_count_result
    ? $animals_count_result->fetch_assoc()['total']
    : 0;


$pets_count_result =
    $conn->query(
        "SELECT COUNT(*) AS total FROM pets"
    );

$total_pets =
    $pets_count_result
    ? $pets_count_result->fetch_assoc()['total']
    : 0;


$animals_helped =
    $total_animals + $total_pets;


/* ==========================================
   CONTACT REPLIES
========================================== */

$stmt = $conn->prepare(
    "SELECT COUNT(*) AS total
     FROM contact_messages
     WHERE user_id = ?
     AND reply IS NOT NULL
     AND reply != ''"
);

$stmt->bind_param("i", $user_id);
$stmt->execute();

$reply_count =
    $stmt->get_result()->fetch_assoc()['total'];


/* ==========================================
   LATEST ADMIN REPLY
========================================== */

$stmt = $conn->prepare(
    "SELECT
        id,
        subject,
        reply,
        reply_at

     FROM contact_messages

     WHERE user_id = ?
     AND reply IS NOT NULL
     AND reply != ''

     ORDER BY reply_at DESC

     LIMIT 1"
);

$stmt->bind_param("i", $user_id);
$stmt->execute();

$reply_result =
    $stmt->get_result();

$latest_reply =
    $reply_result->fetch_assoc();


/* ==========================================
   RECENT ADOPTION ACTIVITY
========================================== */

$sql = "
SELECT
    ar.id,
    ar.status,
    ar.created_at,

    a.name AS animal_name,
    p.name AS old_pet_name

FROM adoption_requests ar

LEFT JOIN animals a
    ON ar.animal_id = a.id

LEFT JOIN pets p
    ON ar.pet_id = p.id

WHERE ar.user_id = ?

ORDER BY ar.created_at DESC

LIMIT 3
";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $user_id);

$stmt->execute();

$recent_result =
    $stmt->get_result();


/* ==========================================
   TIME AGO
========================================== */

function time_ago($datetime)
{

    $diff =
        time() - strtotime($datetime);


    if ($diff < 60) {

        return "Just now";

    }


    if ($diff < 3600) {

        $mins =
            floor($diff / 60);

        return $mins .
               " minute" .
               ($mins > 1 ? "s" : "") .
               " ago";

    }


    if ($diff < 86400) {

        $hours =
            floor($diff / 3600);

        return $hours .
               " hour" .
               ($hours > 1 ? "s" : "") .
               " ago";

    }


    $days =
        floor($diff / 86400);


    if ($days == 1) {

        return "Yesterday";

    }


    return $days . " days ago";

}
/* ==========================================
   COMPLETED ADOPTION
   GET THIS USER'S LATEST COMPLETED ADOPTION
========================================== */

$completed_adoption = null;

$stmt = $conn->prepare(
    "SELECT
        ar.id,
        ar.status,
        ar.created_at,
        a.name AS animal_name,
        p.name AS old_pet_name

     FROM adoption_requests ar

     LEFT JOIN animals a
        ON ar.animal_id = a.id

     LEFT JOIN pets p
        ON ar.pet_id = p.id

     WHERE ar.user_id = ?
     AND ar.status = 'Completed'

     ORDER BY ar.id DESC

     LIMIT 1"
);

if ($stmt) {

    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $completed_result = $stmt->get_result();

    if ($completed_result->num_rows > 0) {

        $completed_adoption =
            $completed_result->fetch_assoc();

    }

    $stmt->close();
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>
PawConnect Dashboard
</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link rel="stylesheet"
href="user_dashboard.css">

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
       class="menu active">

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



    <!-- MY MESSAGES -->

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
       class="menu">

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
                PAWCONNECT DASHBOARD
            </p>


            <h1>

                Welcome back,

                <?php
                echo htmlspecialchars(
                    $_SESSION['user_name']
                );
                ?>

                ! 👋

            </h1>

        </div>



        <div class="top-right">


            <div class="notification">

                <i class="fa-regular fa-bell"></i>


                <span>

                    <?php
                    echo $my_requests_pending;
                    ?>

                </span>

            </div>



            <div class="profile">


                <div class="profile-icon">

                    <i class="fa-regular fa-user"></i>

                </div>


                <div>

                    <h4>

                        <?php

                        echo htmlspecialchars(
                            $_SESSION['user_name']
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



    <!-- ================= WELCOME CARD ================= -->

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


            <a href="animals.php"
               class="primary-btn">

                <i class="fa-solid fa-paw"></i>

                Explore Animals

            </a>


        </div>



        <div class="welcome-paws">

            <i class="fa-solid fa-paw paw-one"></i>

            <i class="fa-solid fa-paw paw-two"></i>

            <i class="fa-solid fa-paw paw-three"></i>

            <i class="fa-solid fa-heart heart-one"></i>

        </div>


    </div>



    <!-- ================= STATISTICS ================= -->

    <div class="section-heading">

        <div>

            <h2>
                Your PawConnect Overview
            </h2>

            <p>
                Your journey towards making a difference.
            </p>

        </div>

    </div>



    <div class="stats">


        <!-- RESCUED ANIMALS -->

        <div class="stat-card">

            <div class="stat-icon green">

                <i class="fa-solid fa-paw"></i>

            </div>


            <div>

                <h3>
                    <?php echo $total_animals; ?>
                </h3>

                <p>
                    Rescued Animals
                </p>

            </div>


            <span class="stat-arrow">

                <i class="fa-solid fa-arrow-up"></i>

            </span>

        </div>



        <!-- REQUESTS -->

        <div class="stat-card">

            <div class="stat-icon gold">

                <i class="fa-solid fa-heart"></i>

            </div>


            <div>

                <h3>
                    <?php echo $my_requests_total; ?>
                </h3>

                <p>
                    Your Adoption Requests
                </p>

            </div>


            <span class="stat-arrow">

                <i class="fa-solid fa-arrow-up"></i>

            </span>

        </div>



        <!-- APPROVED / COMPLETED -->

        <div class="stat-card">

            <div class="stat-icon blue">

                <i class="fa-solid fa-house"></i>

            </div>


            <div>

                <h3>
                    <?php echo $my_requests_approved; ?>
                </h3>

                <p>
                    Your Successful Adoptions
                </p>

            </div>


            <span class="stat-arrow">

                <i class="fa-solid fa-arrow-up"></i>

            </span>

        </div>



        <!-- ANIMALS HELPED -->

        <div class="stat-card">

            <div class="stat-icon red">

                <i class="fa-solid fa-shield-heart"></i>

            </div>


            <div>

                <h3>
                    <?php echo $animals_helped; ?>
                </h3>

                <p>
                    Animals Helped
                </p>

            </div>


            <span class="stat-arrow">

                <i class="fa-solid fa-arrow-up"></i>

            </span>

        </div>


    </div>


<!-- =================================================
     ADOPTION COMPLETED CARD
================================================= -->

<?php if ($completed_adoption) { ?>

<div class="completion-card">

    <!-- PAW DECORATION -->

    <div class="completion-paw paw-left">
        <i class="fa-solid fa-paw"></i>
    </div>

    <div class="completion-paw paw-right">
        <i class="fa-solid fa-paw"></i>
    </div>


    <!-- ICON -->

    <div class="completion-icon">

        <i class="fa-solid fa-check"></i>

    </div>


    <!-- SMALL TITLE -->

    <span class="completion-label">
        ADOPTION COMPLETED
    </span>


    <!-- HEADING -->

    <h2>
        Congratulations!
        <span>🎉</span>
    </h2>


    <!-- DESCRIPTION -->

    <p class="completion-description">

        Your adoption journey is officially complete.

    </p>


    <?php

    $completed_animal_name =
        !empty($completed_adoption['animal_name'])
        ? $completed_adoption['animal_name']
        : (
            !empty($completed_adoption['old_pet_name'])
            ? $completed_adoption['old_pet_name']
            : "Your new companion"
        );

    ?>


    <!-- ANIMAL MESSAGE -->

    <div class="completion-message">

        <i class="fa-solid fa-heart"></i>

        <p>

            <strong>
                <?php
                echo htmlspecialchars(
                    $completed_animal_name
                );
                ?>
            </strong>

            has found a forever home with you.

        </p>

        <i class="fa-solid fa-heart"></i>

    </div>


    <!-- COMPLETION DATE -->

    <div class="completion-date">

        <i class="fa-regular fa-calendar-check"></i>

        Adoption completed on

        <strong>

            <?php

            echo date(
                "d M Y",
                strtotime(
                    $completed_adoption['created_at']
                )
            );

            ?>

        </strong>

    </div>


    <!-- ACTIONS -->

    <div class="completion-actions">

        <div class="completed-badge">

            <i class="fa-solid fa-circle-check"></i>

            Adoption Completed

        </div>


        <a
            href="adoption_details.php?id=<?php echo intval($completed_adoption['id']); ?>"
            class="details-btn">

            View Adoption Details

            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>


    <!-- FOOTER MESSAGE -->

    <div class="completion-footer">

        <i class="fa-solid fa-paw"></i>

        Thank you for giving a rescued animal
        a loving forever home.

        <i class="fa-solid fa-paw"></i>

    </div>

</div>

<?php } ?>


    <!-- =================================================
         ADMIN REPLY
    ================================================= -->

    <?php if ($latest_reply) { ?>

    <div class="reply-card">


        <div class="reply-card-header">


            <div>

                <span class="reply-small-title">

                    PAWCONNECT MESSAGE

                </span>


                <h2>

                    You have a reply from PawConnect

                </h2>

            </div>


            <div class="reply-icon">

                <i class="fa-solid fa-reply"></i>

            </div>


        </div>



        <div class="reply-subject">

            <strong>
                Subject:
            </strong>

            <?php

            echo htmlspecialchars(
                $latest_reply['subject']
            );

            ?>

        </div>



        <div class="reply-message">

            <?php

            echo nl2br(
                htmlspecialchars(
                    $latest_reply['reply']
                )
            );

            ?>

        </div>



        <div class="reply-footer">


            <span>

                <i class="fa-regular fa-clock"></i>

                <?php

                echo date(
                    "d M Y, h:i A",
                    strtotime(
                        $latest_reply['reply_at']
                    )
                );

                ?>

            </span>



            <a href="my_messages.php">

                View All Messages

                <i class="fa-solid fa-arrow-right"></i>

            </a>


        </div>


    </div>

    <?php } ?>



    <!-- ================= LOWER SECTION ================= -->

    <div class="lower-section">


        <!-- QUICK ACTIONS -->

        <div class="quick-card">


            <div class="card-title">


                <div>

                    <h2>
                        Quick Actions
                    </h2>

                    <p>
                        Start making an impact.
                    </p>

                </div>


                <i class="fa-solid fa-bolt"></i>

            </div>



            <div class="actions">


                <a href="animals.php"
                   class="action">


                    <div class="action-icon">

                        <i class="fa-solid fa-paw"></i>

                    </div>


                    <div>

                        <h4>
                            Explore Animals
                        </h4>

                        <p>
                            Find rescued pets
                        </p>

                    </div>


                    <i class="fa-solid fa-arrow-right"></i>

                </a>



                <a href="my_requests.php"
                   class="action">


                    <div class="action-icon">

                        <i class="fa-solid fa-heart"></i>

                    </div>


                    <div>

                        <h4>
                            Adoption Request
                        </h4>

                        <p>
                            View your adoption journey
                        </p>

                    </div>


                    <i class="fa-solid fa-arrow-right"></i>

                </a>



                <a href="my_messages.php"
                   class="action">


                    <div class="action-icon">

                        <i class="fa-regular fa-message"></i>

                    </div>


                    <div>

                        <h4>
                            My Messages
                        </h4>


                        <p>

                            <?php

                            if ($reply_count > 0) {

                                echo $reply_count .
                                     " reply available";

                            } else {

                                echo "Contact PawConnect";

                            }

                            ?>

                        </p>

                    </div>


                    <i class="fa-solid fa-arrow-right"></i>

                </a>



                <a href="home.php"
                   class="action">


                    <div class="action-icon">

                        <i class="fa-solid fa-house"></i>

                    </div>


                    <div>

                        <h4>
                            Go to Home
                        </h4>

                        <p>
                            Back to the main site
                        </p>

                    </div>


                    <i class="fa-solid fa-arrow-right"></i>

                </a>


            </div>


        </div>
        <!-- ================= RECENT ACTIVITY ================= -->

        <div class="activity-card">


            <div class="card-title">


                <div>

                    <h2>
                        Recent Activity
                    </h2>

                    <p>
                        Your latest updates.
                    </p>

                </div>


                <i class="fa-regular fa-clock"></i>


            </div>



            <?php if ($recent_result->num_rows == 0) { ?>


            <div class="activity">


                <div class="activity-icon">

                    <i class="fa-solid fa-paw"></i>

                </div>


                <div>

                    <h4>
                        No activity yet
                    </h4>

                    <p>
                        Your adoption requests
                        will show up here.
                    </p>

                </div>


            </div>


            <?php } ?>


            <?php

            while (
                $activity =
                $recent_result->fetch_assoc()
            ) {


                $activity_animal_name =
                    !empty($activity['animal_name'])
                    ? $activity['animal_name']
                    : (
                        !empty($activity['old_pet_name'])
                        ? $activity['old_pet_name']
                        : "an animal"
                    );


                $activity_status =
                    $activity['status'];


                if (
                    $activity_status == "Completed"
                ) {

                    $activity_title =
                        "Adoption Completed 🎉";

                    $activity_message =
                        "Congratulations! "
                        .
                        $activity_animal_name
                        .
                        " has officially found a forever home with you.";

                }


                elseif (
                    $activity_status == "Approved"
                ) {

                    $activity_title =
                        "Adoption Request Approved";

                    $activity_message =
                        "Your adoption request for "
                        .
                        $activity_animal_name
                        .
                        " has been approved. Please complete the handover.";

                }


                elseif (
                    $activity_status ==
                    "Rejected - Animal Adopted"
                ) {

                    $activity_title =
                        "Animal Already Adopted";

                    $activity_message =
                        $activity_animal_name
                        .
                        " was adopted by someone else before your request was reviewed.";

                }


                elseif (
                    strpos(
                        $activity_status,
                        "Rejected"
                    ) === 0
                ) {

                    $activity_title =
                        "Adoption Request Rejected";

                    $activity_message =
                        "Your request for "
                        .
                        $activity_animal_name
                        .
                        " was not approved this time.";

                }


                else {

                    $activity_title =
                        "Adoption Request Submitted";

                    $activity_message =
                        $activity_animal_name
                        .
                        "'s adoption request is under review.";

                }

            ?>


            <div class="activity">


                <div class="activity-icon">

                    <?php if ($activity_status == "Completed") { ?>

                        <i class="fa-solid fa-circle-check"></i>

                    <?php } else { ?>

                        <i class="fa-solid fa-heart"></i>

                    <?php } ?>

                </div>


                <div>


                    <h4>

                        <?php

                        echo htmlspecialchars(
                            $activity_title
                        );

                        ?>

                    </h4>


                    <p>

                        <?php

                        echo htmlspecialchars(
                            $activity_message
                        );

                        ?>

                    </p>


                    <span>

                        <?php

                        echo time_ago(
                            $activity['created_at']
                        );

                        ?>

                    </span>


                </div>


            </div>


            <?php } ?>


        </div>


    </div>



    <!-- ================= FOOTER ================= -->

    <div class="footer">


        <p>

            © 2026 PawConnect.
            Every paw deserves a forever home. 🐾

        </p>


        <div>

            <span>
                Privacy
            </span>

            <span>
                Terms
            </span>

            <span>
                Help
            </span>

        </div>


    </div>


</div>


</body>

</html>