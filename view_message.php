<?php

include "db.php";

/* ================= GET MESSAGE ID ================= */

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid message ID.");
}

$id = intval($_GET['id']);


/* ================= FETCH MESSAGE ================= */

$query = "SELECT * FROM contact_messages WHERE id = $id";

$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Message not found.");
}

$message = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>View Message | PawConnect</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="stylesheet"
href="view_message.css">

</head>

<body>


<div class="page">


    <!-- ================= HEADER ================= -->

    <div class="page-header">

        <a href="admin_dashboard.php"
           class="back-btn">

            <i class="fa-solid fa-arrow-left"></i>

            Back to Dashboard

        </a>


        <div class="admin-title">

            <i class="fa-solid fa-user-shield"></i>

            Admin Panel

        </div>

    </div>



    <!-- ================= MESSAGE CARD ================= -->

    <div class="message-card">


        <div class="message-header">

            <div>

                <span class="small-title">
                    CONTACT MESSAGE
                </span>

                <h1>
                    Message Details
                </h1>

            </div>


            <span class="status">

                <?php
                echo htmlspecialchars($message['status']);
                ?>

            </span>

        </div>



        <!-- ================= DETAILS ================= -->

        <div class="details">


            <div class="detail-box">

                <i class="fa-solid fa-user"></i>

                <div>

                    <span>
                        Name
                    </span>

                    <strong>

                        <?php
                        echo htmlspecialchars(
                            $message['name']
                        );
                        ?>

                    </strong>

                </div>

            </div>



            <div class="detail-box">

                <i class="fa-solid fa-envelope"></i>

                <div>

                    <span>
                        Email
                    </span>

                    <strong>

                        <?php
                        echo htmlspecialchars(
                            $message['email']
                        );
                        ?>

                    </strong>

                </div>

            </div>



            <div class="detail-box">

                <i class="fa-solid fa-phone"></i>

                <div>

                    <span>
                        Phone
                    </span>

                    <strong>

                        <?php
                        echo htmlspecialchars(
                            $message['phone']
                        );
                        ?>

                    </strong>

                </div>

            </div>



            <div class="detail-box">

                <i class="fa-solid fa-calendar"></i>

                <div>

                    <span>
                        Date
                    </span>

                    <strong>

                        <?php
                        echo date(
                            "d M Y, h:i A",
                            strtotime(
                                $message['created_at']
                            )
                        );
                        ?>

                    </strong>

                </div>

            </div>


        </div>



        <!-- ================= SUBJECT ================= -->

        <div class="subject-box">

            <span>
                Subject
            </span>

            <h3>

                <?php
                echo htmlspecialchars(
                    $message['subject']
                );
                ?>

            </h3>

        </div>



        <!-- ================= MESSAGE ================= -->

        <div class="message-content">

            <div class="message-title">

                <i class="fa-regular fa-message"></i>

                Message

            </div>


            <p>

                <?php
                echo nl2br(
                    htmlspecialchars(
                        $message['message']
                    )
                );
                ?>

            </p>

        </div>



        <!-- ================= ACTIONS ================= -->

        <div class="actions">

            <a href="admin_dashboard.php"
               class="back-action">

                <i class="fa-solid fa-arrow-left"></i>

                Back

            </a>


            <a href="mailto:<?php echo htmlspecialchars($message['email']); ?>"
               class="reply-action">

                <i class="fa-solid fa-reply"></i>

                Reply via Email
                    </a>
                    
                <a href="mark_read.php?id=<?php echo $message['id']; ?>"
               class="read-action">

               <i class="fa-solid fa-check"></i>

                 Mark as Read

            </a>

            

        </div>


    </div>

</div>


</body>

</html>