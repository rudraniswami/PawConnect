<?php

include "db.php";

session_start();


/* ================= GET MESSAGE ID ================= */

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    die("Invalid message ID.");

}

$id = intval($_GET['id']);


/* ================= SEND REPLY ================= */

if (isset($_POST['send_reply'])) {

    $reply = trim($_POST['reply']);

    if ($reply != "") {

        $stmt = $conn->prepare("
            UPDATE contact_messages
            SET reply = ?, reply_at = NOW()
            WHERE id = ?
        ");

        $stmt->bind_param(
            "si",
            $reply,
            $id
        );

        if ($stmt->execute()) {

            $stmt->close();

            header("Location: view_message.php?id=" . $id);
            exit();

        } else {

            $reply_error = "Unable to send reply.";

        }

        $stmt->close();

    } else {

        $reply_error = "Please write a reply.";

    }

}


/* ================= FETCH MESSAGE ================= */

$stmt = $conn->prepare("
    SELECT *
    FROM contact_messages
    WHERE id = ?
");

$stmt->bind_param("i", $id);

$stmt->execute();

$result = $stmt->get_result();


if ($result->num_rows == 0) {

    die("Message not found.");

}

$message = $result->fetch_assoc();

$stmt->close();

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


<style>

/* =========================
   REPLY SECTION
========================= */

.reply-section{

    margin-top:30px;

    padding:30px;

    background:#F5EFE3;

    border-radius:25px;

}


.reply-title{

    display:flex;

    align-items:center;

    gap:10px;

    color:#123C2A;

    font-size:24px;

    font-weight:bold;

    margin-bottom:15px;

}


.reply-title i{

    color:#C6A15B;

}


.reply-section p{

    color:#666;

    margin-bottom:18px;

}


.reply-section textarea{

    width:100%;

    min-height:150px;

    padding:15px;

    border:1px solid #d8d0c3;

    border-radius:15px;

    background:#FFFDF7;

    font-family:'Times New Roman', Times, serif;

    font-size:17px;

    resize:vertical;

    outline:none;

}


.reply-section textarea:focus{

    border-color:#C6A15B;

}


.reply-btn{

    margin-top:15px;

    padding:13px 28px;

    border:none;

    border-radius:30px;

    background:#123C2A;

    color:white;

    font-weight:bold;

    font-size:16px;

    cursor:pointer;

}


.reply-btn:hover{

    background:#1D6747;

}


.reply-error{

    background:#f8d7da;

    color:#721c24;

    padding:12px 15px;

    border-radius:10px;

    margin-bottom:15px;

}


.existing-reply{

    margin-top:30px;

    padding:25px;

    background:#E3F2E6;

    border-radius:20px;

}


.existing-reply-title{

    color:#123C2A;

    font-size:22px;

    font-weight:bold;

    margin-bottom:12px;

}


.existing-reply p{

    color:#444;

    line-height:1.7;

}


.reply-date{

    display:block;

    margin-top:12px;

    color:#777;

    font-size:14px;

}


/* Hide email reply because we don't need it */

.reply-action{

    display:none !important;

}

</style>

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

                echo htmlspecialchars(
                    $message['status'] ?? 'Unread'
                );

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



        <!-- ================= ADMIN REPLY ================= -->

        <?php if (!empty($message['reply'])) { ?>


            <div class="existing-reply">


                <div class="existing-reply-title">

                    <i class="fa-solid fa-reply"></i>

                    Your Reply

                </div>


                <p>

                    <?php

                    echo nl2br(
                        htmlspecialchars(
                            $message['reply']
                        )
                    );

                    ?>

                </p>


                <?php if (!empty($message['reply_at'])) { ?>

                    <span class="reply-date">

                        Replied on:

                        <?php

                        echo date(
                            "d M Y, h:i A",
                            strtotime(
                                $message['reply_at']
                            )
                        );

                        ?>

                    </span>

                <?php } ?>


            </div>


        <?php } else { ?>


            <div class="reply-section">


                <div class="reply-title">

                    <i class="fa-solid fa-reply"></i>

                    Reply to User

                </div>


                <p>

                    Write your response here.
                    The user will be able to see this reply
                    from their PawConnect account.

                </p>


                <?php if (isset($reply_error)) { ?>

                    <div class="reply-error">

                        <?php

                        echo htmlspecialchars(
                            $reply_error
                        );

                        ?>

                    </div>

                <?php } ?>


                <form method="POST"
                      action="view_message.php?id=<?php echo $id; ?>">


                    <textarea
                        name="reply"
                        placeholder="Write your reply to the user..."
                        required></textarea>


                    <button type="submit"
                            name="send_reply"
                            class="reply-btn">

                        <i class="fa-solid fa-paper-plane"></i>

                        Send Reply

                    </button>


                </form>


            </div>


        <?php } ?>



        <!-- ================= ACTIONS ================= -->

        <div class="actions">


            <a href="admin_dashboard.php"
               class="back-action">

                <i class="fa-solid fa-arrow-left"></i>

                Back

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