<?php

session_start();
include "db.php";


/* =====================================================
   CHECK ADMIN LOGIN
===================================================== */

if (!isset($_SESSION['admin_email'])) {

    header("Location: admin_login.php");
    exit();

}


/* =====================================================
   GET ALL ANIMALS WITH NGO NAME
===================================================== */

$query = "
    SELECT
        animals.id,
        animals.name,
        animals.type,
        animals.breed,
        animals.age,
        animals.gender,
        animals.image,
        animals.status,
        animals.health_status,
        animals.location,
        animals.description,
        animals.created_at,
        ngos.name AS ngo_name

    FROM animals

    LEFT JOIN ngos
        ON animals.ngo_id = ngos.id

    ORDER BY animals.id DESC
";


$result = mysqli_query($conn, $query);


if (!$result) {

    die(
        "Unable to load animals: " .
        mysqli_error($conn)
    );

}


/* =====================================================
   STATISTICS
===================================================== */

$total_animals = 0;
$available_animals = 0;
$pending_animals = 0;
$adopted_animals = 0;


$count_query = "
    SELECT
        COUNT(*) AS total,
        SUM(status = 'Available') AS available,
        SUM(status = 'Pending') AS pending,
        SUM(status = 'Adopted') AS adopted
    FROM animals
";


$count_result = mysqli_query(
    $conn,
    $count_query
);


if ($count_result) {

    $count = mysqli_fetch_assoc(
        $count_result
    );

    $total_animals =
        (int)$count['total'];

    $available_animals =
        (int)$count['available'];

    $pending_animals =
        (int)$count['pending'];

    $adopted_animals =
        (int)$count['adopted'];

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

<title>
    Manage Animals | PawConnect Admin
</title>


<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
>


<style>

/* =====================================================
   RESET
===================================================== */

* {

    margin: 0;
    padding: 0;
    box-sizing: border-box;

}


/* =====================================================
   BODY
===================================================== */

body {

    font-family: Georgia, serif;

    background: #f7f3e9;

    color: #173f50;

}


/* =====================================================
   CONTAINER
===================================================== */

.container {

    width: 94%;

    max-width: 1300px;

    margin: 35px auto;

}


/* =====================================================
   HEADER
===================================================== */

.header {

    margin-bottom: 25px;

}


.heading h1 {

    font-size: 32px;

    color: #173f50;

}


.heading h1 i {

    margin-right: 8px;

}


.heading p {

    margin-top: 7px;

    color: #71808a;

    font-size: 15px;

}


/* =====================================================
   STATISTICS
===================================================== */

.stats {

    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 16px;

    margin-bottom: 25px;

}


.stat-card {

    background: #fffdf8;

    padding: 20px;

    border-radius: 13px;

    box-shadow:
        0 5px 18px rgba(0,0,0,0.07);

    display: flex;

    align-items: center;

    gap: 15px;

}


.stat-icon {

    width: 50px;

    height: 50px;

    border-radius: 11px;

    background: #e8dfc7;

    color: #315b70;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 21px;

}


.stat-number {

    font-size: 26px;

    font-weight: bold;

    color: #173f50;

}


.stat-label {

    margin-top: 3px;

    color: #71808a;

    font-size: 13px;

}


/* =====================================================
   TABLE BOX
===================================================== */

.table-box {

    background: #fffdf8;

    padding: 22px;

    border-radius: 14px;

    box-shadow:
        0 5px 20px rgba(0,0,0,0.08);

    overflow-x: auto;

}


.table-title {

    font-size: 21px;

    color: #173f50;

    margin-bottom: 18px;

}


/* =====================================================
   TABLE
===================================================== */

table {

    width: 100%;

    border-collapse: collapse;

    min-width: 1150px;

}


th {

    background: #315b70;

    color: white;

    padding: 14px 12px;

    text-align: left;

    font-size: 14px;

}


td {

    padding: 13px 12px;

    border-bottom:
        1px solid #e5e0d5;

    color: #4e5e65;

    font-size: 14px;

    vertical-align: middle;

}


tr:hover {

    background: #faf7ef;

}


/* =====================================================
   IMAGE
===================================================== */

.animal-img {

    width: 65px;

    height: 65px;

    object-fit: cover;

    border-radius: 9px;

    border: 1px solid #ddd5c5;

}


.no-image {

    width: 65px;

    height: 65px;

    background: #eee8da;

    border-radius: 9px;

    display: flex;

    align-items: center;

    justify-content: center;

    color: #777;

}


/* =====================================================
   NGO
===================================================== */

.ngo-name {

    color: #315b70;

    font-weight: bold;

}


/* =====================================================
   STATUS
===================================================== */

.status {

    display: inline-block;

    padding: 6px 11px;

    border-radius: 15px;

    background: #e8dfc7;

    color: #315b70;

    font-size: 12px;

}


/* =====================================================
   ACTIONS
===================================================== */

.actions {

    white-space: nowrap;

}


.view-btn,
.edit-btn,
.delete-btn {

    display: inline-block;

    text-decoration: none;

    padding: 8px 10px;

    border-radius: 6px;

    color: white;

    margin-right: 4px;

    font-size: 13px;

}


.view-btn {

    background: #6b7f87;

}


.view-btn:hover {

    background: #53676f;

}


.edit-btn {

    background: #315b70;

}


.edit-btn:hover {

    background: #24495c;

}


.delete-btn {

    background: #8b5365;

}


.delete-btn:hover {

    background: #713f50;

}


/* =====================================================
   EMPTY
===================================================== */

.empty {

    text-align: center;

    padding: 50px;

    color: #777;

}


.empty i {

    font-size: 40px;

    margin-bottom: 15px;

    color: #c6a15b;

}


/* =====================================================
   BACK
===================================================== */

.back {

    display: inline-block;

    margin-top: 20px;

    text-decoration: none;

    color: #315b70;

    font-size: 14px;

}


.back:hover {

    text-decoration: underline;

}


/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 900px) {

    .stats {

        grid-template-columns:
            repeat(2, 1fr);

    }

}


@media (max-width: 550px) {

    .stats {

        grid-template-columns: 1fr;

    }

    .heading h1 {

        font-size: 27px;

    }

}

</style>

</head>


<body>


<div class="container">


    <!-- =================================================
         HEADER
    ================================================== -->

    <div class="header">

        <div class="heading">

            <h1>

                <i class="fa-solid fa-paw"></i>

                Manage Animals

            </h1>


            <p>

                View and manage animals submitted by registered NGOs.

            </p>

        </div>

    </div>


    <!-- =================================================
         STATISTICS
    ================================================== -->

    <div class="stats">


        <!-- TOTAL -->

        <div class="stat-card">

            <div class="stat-icon">

                <i class="fa-solid fa-paw"></i>

            </div>

            <div>

                <div class="stat-number">

                    <?php
                    echo $total_animals;
                    ?>

                </div>

                <div class="stat-label">

                    Total Animals

                </div>

            </div>

        </div>


        <!-- AVAILABLE -->

        <div class="stat-card">

            <div class="stat-icon">

                <i class="fa-solid fa-heart"></i>

            </div>

            <div>

                <div class="stat-number">

                    <?php
                    echo $available_animals;
                    ?>

                </div>

                <div class="stat-label">

                    Available

                </div>

            </div>

        </div>


        <!-- PENDING -->

        <div class="stat-card">

            <div class="stat-icon">

                <i class="fa-solid fa-clock"></i>

            </div>

            <div>

                <div class="stat-number">

                    <?php
                    echo $pending_animals;
                    ?>

                </div>

                <div class="stat-label">

                    Pending

                </div>

            </div>

        </div>


        <!-- ADOPTED -->

        <div class="stat-card">

            <div class="stat-icon">

                <i class="fa-solid fa-house"></i>

            </div>

            <div>

                <div class="stat-number">

                    <?php
                    echo $adopted_animals;
                    ?>

                </div>

                <div class="stat-label">

                    Adopted

                </div>

            </div>

        </div>


    </div>


    <!-- =================================================
         TABLE
    ================================================== -->

    <div class="table-box">


        <div class="table-title">

            All Animal Records

        </div>


        <table>


            <thead>

                <tr>

                    <th>Image</th>

                    <th>Name</th>

                    <th>Type</th>

                    <th>Breed</th>

                    <th>Age</th>

                    <th>Gender</th>

                    <th>NGO</th>

                    <th>Health</th>

                    <th>Status</th>

                    <th>Action</th>

                </tr>

            </thead>


            <tbody>


            <?php

            if (
                mysqli_num_rows($result) > 0
            ) {

                while (
                    $animal =
                    mysqli_fetch_assoc($result)
                ) {

            ?>


                <tr>


                    <!-- IMAGE -->

                    <td>

                        <?php

                        if (
                            !empty(
                                $animal['image']
                            )
                        ) {

                        ?>

                            <img
                                src="<?php
                                    echo htmlspecialchars(
                                        $animal['image']
                                    );
                                ?>"
                                class="animal-img"
                                alt="<?php
                                    echo htmlspecialchars(
                                        $animal['name']
                                    );
                                ?>"
                            >

                        <?php

                        } else {

                        ?>

                            <div class="no-image">

                                <i
                                    class="fa-solid fa-paw"
                                ></i>

                            </div>

                        <?php

                        }

                        ?>

                    </td>


                    <!-- NAME -->

                    <td>

                        <strong>

                            <?php

                            echo htmlspecialchars(
                                $animal['name']
                            );

                            ?>

                        </strong>

                    </td>


                    <!-- TYPE -->

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $animal['type']
                        );

                        ?>

                    </td>


                    <!-- BREED -->

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $animal['breed']
                        );

                        ?>

                    </td>


                    <!-- AGE -->

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $animal['age']
                        );

                        ?>

                    </td>


                    <!-- GENDER -->

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $animal['gender']
                        );

                        ?>

                    </td>


                    <!-- NGO -->

                    <td>

                        <span class="ngo-name">

                            <?php

                            if (
                                !empty(
                                    $animal['ngo_name']
                                )
                            ) {

                                echo htmlspecialchars(
                                    $animal['ngo_name']
                                );

                            } else {

                                echo "Unknown NGO";

                            }

                            ?>

                        </span>

                    </td>


                    <!-- HEALTH -->

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $animal['health_status']
                        );

                        ?>

                    </td>


                    <!-- STATUS -->

                    <td>

                        <span class="status">

                            <?php

                            echo htmlspecialchars(
                                $animal['status']
                            );

                            ?>

                        </span>

                    </td>


                    <!-- ACTION -->

                    <td class="actions">


                        <!-- VIEW -->

                        <a
                            href="pet_details.php?id=<?php
                                echo (int)$animal['id'];
                            ?>"
                            class="view-btn"
                            title="View Animal"
                        >

                            <i
                                class="fa-solid fa-eye"
                            ></i>

                        </a>


                        <!-- EDIT -->

                        <a
                            href="edit_animal.php?id=<?php
                                echo (int)$animal['id'];
                            ?>"
                            class="edit-btn"
                            title="Edit Animal"
                        >

                            <i
                                class="fa-solid fa-pen"
                            ></i>

                        </a>


                        <!-- DELETE -->

                        <a
                            href="delete_animaladmin.php?id=<?php
                                echo (int)$animal['id'];
                            ?>"
                            class="delete-btn"
                            title="Delete Animal"
                            onclick="return confirm('Are you sure you want to delete this animal?');"
                        >

                            <i
                                class="fa-solid fa-trash"
                            ></i>

                        </a>


                    </td>


                </tr>


            <?php

                }

            } else {

            ?>


                <tr>

                    <td
                        colspan="10"
                        class="empty"
                    >

                        <i
                            class="fa-solid fa-paw"
                        ></i>

                        <br><br>

                        No animals have been added by NGOs yet.

                    </td>

                </tr>


            <?php

            }

            ?>


            </tbody>

        </table>


    </div>


    <!-- =================================================
         BACK TO DASHBOARD
    ================================================== -->

    <a
        href="admin_dashboard.php"
        class="back"
    >

        <i class="fa-solid fa-arrow-left"></i>

        Back to Dashboard

    </a>


</div>


</body>

</html>