<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$user_id = intval($_SESSION['user_id']);

/* GET USER EMAIL */

$stmt = $conn->prepare(
    "SELECT email FROM users WHERE id = ?"
);

if (!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();

$user_result = $stmt->get_result();

if ($user_result->num_rows == 0) {
    die("User not found.");
}

$user = $user_result->fetch_assoc();

$user_email = $user['email'];

$stmt->close();


/* GET USER MESSAGES */

$stmt = $conn->prepare("
    SELECT
        id,
        subject,
        message,
        reply,
        status,
        created_at
    FROM contact_messages
    WHERE email = ?
    ORDER BY created_at DESC
");

if (!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("s", $user_email);
$stmt->execute();

$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>My Messages | PawConnect</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: #f7f4ed;
    color: #173c2d;
}

.page {
    width: 92%;
    max-width: 1050px;
    margin: 45px auto;
}

/* HEADER */

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 35px;
}

.heading-area h1 {
    font-size: 34px;
    margin-bottom: 8px;
}

.heading-area p {
    color: #777;
    font-size: 15px;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    color: #173c2d;
    font-weight: bold;
    background: white;
    padding: 11px 17px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
}

.back-btn:hover {
    background: #173c2d;
    color: white;
}

/* CARD */

.message-card {
    background: white;
    border-radius: 20px;
    padding: 28px;
    margin-bottom: 25px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.07);
    border: 1px solid #eee;
}

/* TOP */

.message-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.subject {
    font-size: 22px;
    margin-bottom: 10px;
}

.date {
    color: #888;
    font-size: 13px;
    white-space: nowrap;
}

/* STATUS */

.status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 13px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
}

.waiting {
    background: #fff3cd;
    color: #856404;
}

.replied {
    background: #d4edda;
    color: #155724;
}

/* MESSAGE */

.message-box {
    margin-top: 22px;
    background: #f8f7f2;
    border-radius: 14px;
    padding: 20px;
}

.message-title {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 12px;
}

.message-title i {
    margin-right: 7px;
}

.message-text {
    color: #555;
    line-height: 1.7;
    font-size: 15px;
}

/* REPLY */

.reply-box {
    margin-top: 20px;
    background: #eef6f1;
    border-left: 5px solid #173c2d;
    border-radius: 12px;
    padding: 20px;
}

.reply-title {
    font-size: 14px;
    font-weight: bold;
    color: #173c2d;
    margin-bottom: 12px;
}

.reply-title i {
    margin-right: 7px;
}

.reply-text {
    color: #444;
    line-height: 1.7;
    font-size: 15px;
}

/* WAITING */

.waiting-box {
    margin-top: 20px;
    background: #fff9e8;
    border-left: 5px solid #d6a700;
    border-radius: 12px;
    padding: 20px;
}

.waiting-box h3 {
    color: #856404;
    font-size: 16px;
    margin-bottom: 8px;
}

.waiting-box p {
    color: #777;
    line-height: 1.6;
    font-size: 14px;
}

/* NO MESSAGE */

.no-messages {
    background: white;
    border-radius: 20px;
    padding: 65px 30px;
    text-align: center;
    box-shadow: 0 8px 25px rgba(0,0,0,0.07);
}

.no-messages-icon {
    width: 75px;
    height: 75px;
    margin: 0 auto 20px;
    border-radius: 50%;
    background: #edf5f0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.no-messages-icon i {
    font-size: 30px;
    color: #173c2d;
}

.no-messages h2 {
    margin-bottom: 8px;
}

.no-messages p {
    color: #777;
}

/* MOBILE */

@media (max-width: 700px) {

    .page {
        width: 94%;
        margin: 25px auto;
    }

    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 18px;
    }

    .heading-area h1 {
        font-size: 28px;
    }

    .message-card {
        padding: 20px;
    }

    .message-top {
        flex-direction: column;
    }

    .date {
        white-space: normal;
    }

}

</style>

</head>

<body>

<div class="page">

    <!-- HEADER -->

    <div class="page-header">

        <div class="heading-area">

            <h1>
                My Messages
            </h1>

            <p>
                View your messages and replies from the PawConnect team.
            </p>

        </div>

        <a href="user_dashboard.php" class="back-btn">

            <i class="fa-solid fa-arrow-left"></i>

            Back to Dashboard

        </a>

    </div>


<?php if ($result->num_rows == 0) { ?>

    <!-- NO MESSAGES -->

    <div class="no-messages">

        <div class="no-messages-icon">

            <i class="fa-regular fa-message"></i>

        </div>

        <h2>
            No Messages Yet
        </h2>

        <p>
            You haven't sent any messages to PawConnect yet.
        </p>

    </div>

<?php } ?>


<?php while ($row = $result->fetch_assoc()) {

    $reply = trim($row['reply'] ?? '');

    $has_reply = ($reply != "");

?>

    <!-- MESSAGE CARD -->

    <div class="message-card">

        <div class="message-top">

            <div>

                <h2 class="subject">

                    <?php
                    echo htmlspecialchars($row['subject']);
                    ?>

                </h2>

                <?php if ($has_reply) { ?>

                    <span class="status replied">

                        <i class="fa-solid fa-check"></i>

                        Replied

                    </span>

                <?php } else { ?>

                    <span class="status waiting">

                        <i class="fa-solid fa-clock"></i>

                        Waiting for Reply

                    </span>

                <?php } ?>

            </div>


            <div class="date">

                <i class="fa-regular fa-calendar"></i>

                <?php

                echo date(
                    "d M Y, h:i A",
                    strtotime($row['created_at'])
                );

                ?>

            </div>

        </div>


        <!-- USER MESSAGE -->

        <div class="message-box">

            <div class="message-title">

                <i class="fa-regular fa-message"></i>

                Your Message

            </div>

            <p class="message-text">

                <?php

                echo nl2br(
                    htmlspecialchars($row['message'])
                );

                ?>

            </p>

        </div>


        <!-- REPLY -->

        <?php if ($has_reply) { ?>

            <div class="reply-box">

                <div class="reply-title">

                    <i class="fa-solid fa-reply"></i>

                    PawConnect Reply

                </div>

                <p class="reply-text">

                    <?php

                    echo nl2br(
                        htmlspecialchars($reply)
                    );

                    ?>

                </p>

            </div>

        <?php } else { ?>

            <div class="waiting-box">

                <h3>

                    <i class="fa-solid fa-clock"></i>

                    Waiting for Reply

                </h3>

                <p>

                    Your message has been received.
                    Our admin team will reply here on the website.

                </p>

            </div>

        <?php } ?>

    </div>

<?php } ?>

</div>

</body>

</html>