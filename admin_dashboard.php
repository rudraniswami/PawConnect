<?php

include "db.php";

/* ================= FETCH CONTACT MESSAGES ================= */

$query = "SELECT * FROM contact_messages ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Contact query error: " . mysqli_error($conn));
}


/* ================= TOTAL MESSAGES ================= */

$total_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM contact_messages"
);

$total_data = mysqli_fetch_assoc($total_query);

$total_messages = $total_data['total'];


/* ================= NEW MESSAGES ================= */

$new_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS new_messages
     FROM contact_messages
     WHERE status = 'New'"
);

if (!$new_query) {
    die("New messages query error: " . mysqli_error($conn));
}

$new_data = mysqli_fetch_assoc($new_query);

$new_messages = $new_data['new_messages'];

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard | PawConnect</title>


<!-- FONT AWESOME -->

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


<!-- DASHBOARD CSS -->

<link rel="stylesheet"
href="admin_dashboard.css">

</head>


<body>


<!-- ================= SIDEBAR ================= -->

<div class="sidebar">


    <!-- LOGO -->

    <div class="logo">

        <img src="logo.jpeg"
             alt="PawConnect Logo">

        <h2>
            PawConnect
        </h2>

    </div>


    <div class="admin-title">

        ADMIN PANEL

    </div>


    <!-- CONTACT -->

    <a href="admin_dashboard.php"
       class="active">


        Contact Messages

    </a>


    <!-- FUTURE FEATURES -->

    <a href="animals.php">

        <i class="fa-solid fa-paw"></i>

        Animals

    </a>


    <a href="adoptions.php" class="admin-btn">
    View Adoption Requests
</a>


    <a href="ngo.php">

        <i class="fa-solid fa-building"></i>

        NGO Management

    </a>


</div>



<!-- ================= MAIN CONTENT ================= -->

<div class="main">


    <!-- ================= HEADER ================= -->

    <div class="header">

        <div>

            <h1>
                Contact Messages
            </h1>

            <p>
                Manage messages received from
                PawConnect visitors.
            </p>

        </div>


        <div class="admin-profile">

            <i class="fa-solid fa-user-shield"></i>

            <span>
                Admin
            </span>

        </div>

    </div>



    <!-- ================= STATISTICS ================= -->

    <div class="stats">


        <!-- TOTAL -->

        <div class="stat-card">

            <div class="stat-icon">

                <i class="fa-solid fa-envelope"></i>

            </div>


            <div>

                <h3>

                    <?php
                    echo $total_messages;
                    ?>

                </h3>

                <p>
                    Total Messages
                </p>

            </div>

        </div>



        <!-- NEW -->

        <div class="stat-card">

            <div class="stat-icon">

                <i class="fa-solid fa-bell"></i>

            </div>


            <div>

                <h3>

                    <?php
                    echo $new_messages;
                    ?>

                </h3>

                <p>
                    New Messages
                </p>

            </div>

        </div>


    </div>



    <!-- ================= MESSAGE SECTION ================= -->

    <div class="message-section">


        <div class="section-header">


            <h2>

                Recent Messages

            </h2>


            <span class="message-count">

                <?php
                echo $total_messages;
                ?>

                Messages

            </span>


        </div>



        <!-- TABLE -->

        <div class="table-container">


        <?php

        if(mysqli_num_rows($result) > 0)

        {

        ?>


            <table>


                <thead>

                    <tr>

                        <th>
                            Name
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Subject
                        </th>

                        <th>
                            Date
                        </th>

                        <th>
                            Status
                        </th>
                        <th>
                            Action
                       </th>

                    </tr>

                </thead>



                <tbody>


                <?php

                while($row = mysqli_fetch_assoc($result))

                {

                ?>


                    <tr>


                        <td>

                            <?php

                            echo htmlspecialchars(
                                $row['name']
                            );

                            ?>

                        </td>


                        <td>

                            <?php

                            echo htmlspecialchars(
                                $row['email']
                            );

                            ?>

                        </td>


                        <td>

                            <?php

                            echo htmlspecialchars(
                                $row['subject']
                            );

                            ?>

                        </td>


                        <td>

                            <?php

                            echo date(
                                "d M Y",
                                strtotime(
                                    $row['created_at']
                                )
                            );

                            ?>

                        </td>


                        <td>

                            <span class="status">

                                <?php

                                echo htmlspecialchars(
                                    $row['status']
                                );

                                ?>

                            </span>

                        </td>
<td>

    <a href="view_message.php?id=<?php echo $row['id']; ?>"
       class="view-btn">

        <i class="fa-solid fa-eye"></i>
        View

    </a>


    <a href="delete_message.php?id=<?php echo $row['id']; ?>"
       class="delete-btn"
       onclick="return confirm('Are you sure you want to delete this message?');">

        <i class="fa-solid fa-trash"></i>
        Delete

    </a>

</td>

                    </tr>


                <?php

                }

                ?>


                </tbody>


            </table>


        <?php

        }

        else

        {

        ?>


            <div class="empty">


                <i class="fa-regular fa-envelope-open"></i>


                <h3>

                    No Messages Yet

                </h3>


                <p>

                    Contact messages will appear here.

                </p>


            </div>


        <?php

        }

        ?>


        </div>


    </div>


</div>


</body>

</html>