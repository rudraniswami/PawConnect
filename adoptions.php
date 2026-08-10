<?php

session_start();
include "db.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);


/* ==========================================
   APPROVE / REJECT REQUEST
========================================== */

if (isset($_GET['action']) && isset($_GET['id'])) {

    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action == "approve") {

        $status = "Approved";

    } elseif ($action == "reject") {

        $status = "Rejected";

    } else {

        $status = "Pending";

    }


    $stmt = $conn->prepare(
        "UPDATE adoption_requests
         SET status = ?
         WHERE id = ?"
    );

    $stmt->bind_param("si", $status, $id);

    $stmt->execute();

    header("Location: adoptions.php");
    exit();

}


/* ==========================================
   FETCH ADOPTION REQUESTS
========================================== */

$query = "
    SELECT *
    FROM adoption_requests
    ORDER BY created_at DESC
";

$result = mysqli_query($conn, $query);

if (!$result) {

    die("Database Error: " . mysqli_error($conn));

}


/* ==========================================
   COUNT REQUESTS
========================================== */

$total_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM adoption_requests"
);

$total_data = mysqli_fetch_assoc($total_query);

$total_requests = $total_data['total'];


/* ==========================================
   PENDING REQUESTS
========================================== */

$pending_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM adoption_requests
     WHERE status = 'Pending'"
);

$pending_data = mysqli_fetch_assoc($pending_query);

$pending_requests = $pending_data['total'];


/* ==========================================
   APPROVED REQUESTS
========================================== */

$approved_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM adoption_requests
     WHERE status = 'Approved'"
);

$approved_data = mysqli_fetch_assoc($approved_query);

$approved_requests = $approved_data['total'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Adoption Requests | PawConnect</title>

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


<style>

/* ==========================================
   RESET
========================================== */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


body {
    font-family: Arial, sans-serif;
    background: #f8f6ef;
    color: #173c2d;
}


/* ==========================================
   SIDEBAR
========================================== */

.sidebar {

    position: fixed;

    left: 0;
    top: 0;

    width: 240px;
    height: 100vh;

    background: #173c2d;

    padding: 30px 20px;

    color: white;
}


.sidebar-logo {

    display: flex;

    align-items: center;

    gap: 10px;

    margin-bottom: 45px;
}


.sidebar-logo img {

    width: 42px;
    height: 42px;

    border-radius: 50%;
}


.sidebar-logo h2 {

    font-size: 20px;
}


.sidebar p {

    color: #aebdb5;

    font-size: 11px;

    letter-spacing: 2px;

    margin-bottom: 15px;
}


.sidebar a {

    display: flex;

    align-items: center;

    gap: 12px;

    text-decoration: none;

    color: #dbe3de;

    padding: 13px 15px;

    border-radius: 10px;

    margin-bottom: 7px;

    font-size: 14px;
}


.sidebar a:hover,
.sidebar a.active {

    background: rgba(255,255,255,0.12);

    color: white;
}


.sidebar a i {

    width: 20px;
}


/* ==========================================
   MAIN
========================================== */

.main {

    margin-left: 240px;

    padding: 35px 45px;

}


/* ==========================================
   TOP
========================================== */

.topbar {

    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-bottom: 35px;
}


.topbar h1 {

    font-family: Georgia, serif;

    font-size: 34px;

    margin-bottom: 7px;
}


.topbar p {

    color: #718078;

    font-size: 14px;
}


.back-btn {

    text-decoration: none;

    color: #173c2d;

    background: white;

    padding: 11px 18px;

    border-radius: 25px;

    font-size: 13px;

    font-weight: bold;

    box-shadow: 0 5px 15px rgba(0,0,0,.06);
}


/* ==========================================
   STAT CARDS
========================================== */

.stats {

    display: grid;

    grid-template-columns:
    repeat(3, 1fr);

    gap: 20px;

    margin-bottom: 30px;
}


.stat-card {

    background: #fffdf7;

    border-radius: 18px;

    padding: 23px;

    box-shadow:
    0 8px 25px rgba(23,60,45,.06);
}


.stat-top {

    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-bottom: 15px;
}


.stat-icon {

    width: 42px;
    height: 42px;

    border-radius: 12px;

    background: #eeeade;

    display: flex;

    align-items: center;

    justify-content: center;

    color: #173c2d;
}


.stat-card h2 {

    font-size: 28px;

    margin-bottom: 5px;
}


.stat-card p {

    color: #7a847e;

    font-size: 13px;
}


/* ==========================================
   REQUEST AREA
========================================== */

.request-area {

    background: #fffdf7;

    border-radius: 20px;

    padding: 25px;

    box-shadow:
    0 8px 30px rgba(23,60,45,.06);
}


.request-header {

    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-bottom: 25px;
}


.request-header h2 {

    font-family: Georgia, serif;

    font-size: 24px;
}


.request-header span {

    font-size: 13px;

    color: #7a847e;
}


/* ==========================================
   TABLE
========================================== */

.table-wrapper {

    overflow-x: auto;
}


table {

    width: 100%;

    border-collapse: collapse;

    min-width: 850px;
}


th {

    text-align: left;

    background: #f1eee4;

    padding: 14px;

    font-size: 11px;

    letter-spacing: 1px;

    color: #59665f;
}


td {

    padding: 17px 14px;

    border-bottom: 1px solid #ece9df;

    font-size: 13px;

    vertical-align: middle;
}


tr:hover td {

    background: #faf8f1;
}


/* ==========================================
   PET / USER
========================================== */

.person {

    display: flex;

    align-items: center;

    gap: 10px;
}


.person-icon {

    width: 35px;
    height: 35px;

    border-radius: 50%;

    background: #e8e5d9;

    display: flex;

    align-items: center;

    justify-content: center;
}


.person strong {

    display: block;

    margin-bottom: 3px;
}


.person small {

    color: #8a948e;
}


/* ==========================================
   STATUS
========================================== */

.status {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 6px 11px;

    border-radius: 20px;

    font-size: 11px;

    font-weight: bold;
}


.status.pending {

    background: #f4e7c5;

    color: #765d25;
}


.status.approved {

    background: #dceee4;

    color: #286044;
}


.status.rejected {

    background: #f1dddd;

    color: #8a3f3f;
}


/* ==========================================
   ACTIONS
========================================== */

.actions {

    display: flex;

    gap: 7px;

    flex-wrap: wrap;
}


.action-btn {

    text-decoration: none;

    border: none;

    cursor: pointer;

    padding: 8px 11px;

    border-radius: 8px;

    font-size: 11px;

    font-weight: bold;

    display: inline-flex;

    align-items: center;

    gap: 5px;
}


.view-btn {

    background: #eeeade;

    color: #173c2d;
}


.approve-btn {

    background: #dceee4;

    color: #286044;
}


.reject-btn {

    background: #f1dddd;

    color: #8a3f3f;
}


.action-btn:hover {

    opacity: .75;
}


/* ==========================================
   EMPTY
========================================== */

.empty {

    text-align: center;

    padding: 60px 20px;

    color: #7b847f;
}


.empty i {

    font-size: 40px;

    margin-bottom: 15px;

    opacity: .5;
}


/* ==========================================
   MOBILE
========================================== */

@media(max-width:900px) {

    .sidebar {

        width: 70px;

        padding: 25px 10px;
    }


    .sidebar-logo h2,
    .sidebar p,
    .sidebar a span {

        display: none;
    }


    .sidebar a {

        justify-content: center;
    }


    .main {

        margin-left: 70px;

        padding: 25px 20px;
    }


    .stats {

        grid-template-columns: 1fr;
    }

}

</style>

</head>


<body>


<!-- ==========================================
     SIDEBAR
========================================== -->

<aside class="sidebar">


    <div class="sidebar-logo">

        <img src="logo.jpeg"
             alt="PawConnect">

        <h2>PawConnect</h2>

    </div>


    <p>ADMIN PANEL</p>


    <a href="admin_dashboard.php">

        <i class="fa-solid fa-chart-line"></i>

        <span>Dashboard</span>

    </a>


    <a href="adoptions.php"
       class="active">

        <i class="fa-solid fa-paw"></i>

        <span>Adoption Requests</span>

    </a>


    <a href="admin_dashboard.php">

        <i class="fa-solid fa-envelope"></i>

        <span>Messages</span>

    </a>


    <a href="home.php">

        <i class="fa-solid fa-house"></i>

        <span>Visit Website</span>

    </a>


</aside>



<!-- ==========================================
     MAIN
========================================== -->

<main class="main">


    <div class="topbar">

        <div>

            <h1>
                Adoption Requests
            </h1>

            <p>
                Review applications and help every pet
                find the right home.
            </p>

        </div>


        <a href="admin_dashboard.php"
           class="back-btn">

            <i class="fa-solid fa-arrow-left"></i>

            Dashboard

        </a>

    </div>



    <!-- ======================================
         STATISTICS
    ======================================= -->

    <div class="stats">


        <div class="stat-card">

            <div class="stat-top">

                <div>

                    <h2>
                        <?php echo $total_requests; ?>
                    </h2>

                    <p>
                        Total Requests
                    </p>

                </div>


                <div class="stat-icon">

                    <i class="fa-solid fa-file-lines"></i>

                </div>

            </div>

        </div>



        <div class="stat-card">

            <div class="stat-top">

                <div>

                    <h2>
                        <?php echo $pending_requests; ?>
                    </h2>

                    <p>
                        Pending Review
                    </p>

                </div>


                <div class="stat-icon">

                    <i class="fa-solid fa-clock"></i>

                </div>

            </div>

        </div>



        <div class="stat-card">

            <div class="stat-top">

                <div>

                    <h2>
                        <?php echo $approved_requests; ?>
                    </h2>

                    <p>
                        Approved
                    </p>

                </div>


                <div class="stat-icon">

                    <i class="fa-solid fa-circle-check"></i>

                </div>

            </div>

        </div>


    </div>



    <!-- ======================================
         REQUESTS
    ======================================= -->

    <div class="request-area">


        <div class="request-header">

            <div>

                <h2>
                    Recent Applications
                </h2>

                <span>
                    Review each applicant before making a decision.
                </span>

            </div>

        </div>



        <div class="table-wrapper">

        <?php if (mysqli_num_rows($result) > 0) { ?>

        <table>

            <thead>

                <tr>

                    <th>
                        APPLICANT
                    </th>

                    <th>
                        PET ID
                    </th>

                    <th>
                        HOME
                    </th>

                    <th>
                        BUDGET
                    </th>

                    <th>
                        STATUS
                    </th>

                    <th>
                        ACTIONS
                    </th>

                </tr>

            </thead>


            <tbody>


            <?php while ($row = mysqli_fetch_assoc($result)) { ?>


                <tr>


                    <!-- APPLICANT -->

                    <td>

                        <div class="person">

                            <div class="person-icon">

                                <i class="fa-solid fa-user"></i>

                            </div>


                            <div>

                                <strong>
                                    <?php
                                    echo htmlspecialchars(
                                        $row['full_name']
                                    );
                                    ?>
                                </strong>

                                <small>
                                    <?php
                                    echo htmlspecialchars(
                                        $row['email']
                                    );
                                    ?>
                                </small>

                            </div>

                        </div>

                    </td>



                    <!-- PET -->

                    <td>

                        #<?php
                        echo htmlspecialchars(
                            $row['pet_id']
                        );
                        ?>

                    </td>



                    <!-- HOME -->

                    <td>

                        <?php
                        echo htmlspecialchars(
                            $row['home_type']
                        );
                        ?>

                    </td>



                    <!-- BUDGET -->

                    <td>

                        <?php
                        echo htmlspecialchars(
                            $row['monthly_budget']
                        );
                        ?>

                    </td>



                    <!-- STATUS -->

                    <td>


                    <?php

                    $status = $row['status'];

                    if ($status == "Approved") {

                        echo '<span class="status approved">
                              <i class="fa-solid fa-check"></i>
                              Approved
                              </span>';

                    } elseif ($status == "Rejected") {

                        echo '<span class="status rejected">
                              <i class="fa-solid fa-xmark"></i>
                              Rejected
                              </span>';

                    } else {

                        echo '<span class="status pending">
                              <i class="fa-solid fa-clock"></i>
                              Pending
                              </span>';

                    }

                    ?>


                    </td>



                    <!-- ACTIONS -->

                    <td>

                        <div class="actions">


                            <a href="adoption_details.php?id=<?php echo $row['id']; ?>"
                               class="action-btn view-btn">

                                <i class="fa-solid fa-eye"></i>

                                View

                            </a>


                            <?php if ($status != "Approved") { ?>

                            <a href="adoptions.php?action=approve&id=<?php echo $row['id']; ?>"
                               class="action-btn approve-btn"
                               onclick="return confirm('Approve this adoption request?');">

                                <i class="fa-solid fa-check"></i>

                                Approve

                            </a>

                            <?php } ?>


                            <?php if ($status != "Rejected") { ?>

                            <a href="adoptions.php?action=reject&id=<?php echo $row['id']; ?>"
                               class="action-btn reject-btn"
                               onclick="return confirm('Reject this adoption request?');">

                                <i class="fa-solid fa-xmark"></i>

                                Reject

                            </a>

                            <?php } ?>


                        </div>

                    </td>


                </tr>


            <?php } ?>


            </tbody>

        </table>

        <?php } else { ?>


            <div class="empty">

                <i class="fa-solid fa-paw"></i>

                <h3>
                    No adoption requests yet
                </h3>

                <p>
                    New applications will appear here.
                </p>

            </div>


        <?php } ?>


        </div>

    </div>


</main>


</body>

</html>