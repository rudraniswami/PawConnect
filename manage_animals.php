<?php

include "db.php";

$query = "SELECT * FROM animals ORDER BY id DESC";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Manage Animals - PawConnect</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Georgia, serif;
            background: #f7f3e9;
            color: #173f50;
        }

        .container {
            width: 94%;
            max-width: 1250px;
            margin: 35px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .heading h1 {
            font-size: 32px;
            color: #173f50;
        }

        .heading p {
            margin-top: 7px;
            color: #71808a;
            font-size: 15px;
        }

        .add-btn {
            text-decoration: none;
            background: #173f50;
            color: white;
            padding: 13px 20px;
            border-radius: 8px;
            font-size: 15px;
        }

        .add-btn:hover {
            background: #0f2c39;
        }

        .table-box {
            background: #fffdf8;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            overflow-x: auto;
        }

        .table-title {
            font-size: 21px;
            color: #173f50;
            margin-bottom: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 950px;
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
            border-bottom: 1px solid #e5e0d5;
            color: #4e5e65;
            font-size: 14px;
        }

        tr:hover {
            background: #faf7ef;
        }

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

        .status {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 15px;
            background: #e8dfc7;
            color: #315b70;
            font-size: 12px;
        }

        .actions {
            white-space: nowrap;
        }

        .edit-btn,
        .delete-btn {
            display: inline-block;
            text-decoration: none;
            padding: 8px 11px;
            border-radius: 6px;
            color: white;
            margin-right: 5px;
            font-size: 13px;
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

    </style>

</head>


<body>


<div class="container">


    <!-- HEADER -->

    <div class="header">

        <div class="heading">

            <h1>

                <i class="fa-solid fa-paw"></i>

                Manage Animals

            </h1>

            <p>

                Add and manage rescued animals on PawConnect.

            </p>

        </div>


        <a href="add_animaladmin.php" class="add-btn">

            <i class="fa-solid fa-plus"></i>

            Add Animal

        </a>

    </div>



    <!-- TABLE -->

    <div class="table-box">

        <div class="table-title">

            Animal Records

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

                    <th>Health</th>

                    <th>Status</th>

                    <th>Action</th>

                </tr>

            </thead>


            <tbody>


            <?php

            if (mysqli_num_rows($result) > 0) {

                while ($animal = mysqli_fetch_assoc($result)) {

            ?>


                <tr>


                    <!-- IMAGE -->

                    <td>

                        <?php

                        if (!empty($animal['image'])) {

                        ?>

                            <img
                                src="uploads/animals/<?php echo htmlspecialchars($animal['image']); ?>"
                                class="animal-img"
                                alt="Animal">

                        <?php

                        } else {

                        ?>

                            <div class="no-image">

                                <i class="fa-solid fa-paw"></i>

                            </div>

                        <?php

                        }

                        ?>

                    </td>


                    <!-- NAME -->

                    <td>

                        <strong>

                            <?php
                            echo htmlspecialchars($animal['name']);
                            ?>

                        </strong>

                    </td>


                    <!-- TYPE -->

                    <td>

                        <?php
                        echo htmlspecialchars($animal['type']);
                        ?>

                    </td>


                    <!-- BREED -->

                    <td>

                        <?php
                        echo htmlspecialchars($animal['breed']);
                        ?>

                    </td>


                    <!-- AGE -->

                    <td>

                        <?php
                        echo htmlspecialchars($animal['age']);
                        ?>

                    </td>


                    <!-- GENDER -->

                    <td>

                        <?php
                        echo htmlspecialchars($animal['gender']);
                        ?>

                    </td>


                    <!-- HEALTH -->

                    <td>

                        <?php
                        echo htmlspecialchars($animal['health_status']);
                        ?>

                    </td>


                    <!-- STATUS -->

                    <td>

                        <span class="status">

                            <?php
                            echo htmlspecialchars($animal['status']);
                            ?>

                        </span>

                    </td>


                    <!-- ACTION -->

                    <td class="actions">


                        <!-- EDIT -->

                        <a
                            href="edit_animal.php?id=<?php echo $animal['id']; ?>"
                            class="edit-btn"
                            title="Edit Animal">

                            <i class="fa-solid fa-pen"></i>

                        </a>


                        <!-- DELETE -->

                        <a
                            href="delete_animal.php?id=<?php echo $animal['id']; ?>"
                            class="delete-btn"
                            title="Delete Animal"
                            onclick="return confirm('Are you sure you want to delete this animal?');">

                            <i class="fa-solid fa-trash"></i>

                        </a>


                    </td>


                </tr>


            <?php

                }

            } else {

            ?>


                <tr>

                    <td colspan="9" class="empty">

                        <i class="fa-solid fa-paw"></i>

                        <br>

                        No animals added yet.

                    </td>

                </tr>


            <?php

            }

            ?>


            </tbody>

        </table>

    </div>


    <!-- BACK TO DASHBOARD -->

    <a href="ngo_dashboard.php" class="back">

        <i class="fa-solid fa-arrow-left"></i>

        Back to Dashboard

    </a>


</div>


</body>

</html>