<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$user_id = intval($_SESSION['user_id']);

/* ================================
   GET LOGGED-IN USER EMAIL
================================ */

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


/* ================================
   GET USER'S CONTACT MESSAGES
   USING EMAIL
================================ */

$stmt = $conn->prepare("
    SELECT
        id,
        name,
        email,
        phone,
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

.container {

    width: 92%;

    max-width: 1000px;

    margin: 45px auto;

}

.top {

    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-bottom: 30px;

}

.back {

    text-decoration: none;

    color: #173c2d;

    font-weight: bold;

}

h1 {

    font-size: 32px;

    margin-bottom: 8px;

}

.subtitle {

    color: #777;

    margin-bottom: 30px;

}


/* ================= MESSAGE CARD ================= */

.message-card {

    background: white;

    border-radius: 18px;

    padding: 25px;

    margin-bottom: 25px;

    box-shadow: 0 8px 25px rgba(0,0,0,0.08);

}

.message-top {

    display: flex;

    justify-content: space-between;

    align-items: center;

    gap: 15px;

    margin-bottom: 20px;

}

.message-top h2 {

    font-size: 21px;

}

.date {

    color: #888;

    font-size: 13px;

}


/* ================= STATUS ================= */

.status {

    display: inline-block;

    padding: 7px 13px;

    border-radius: 20px;

    font-size: 12px;

    font-weight: bold;

    margin-top: 8px;

}

.pending {

    background: #fff3cd;

    color: #856404;

}

.replied {

    background: #d4edda;

    color: #155724;

}


/* ================= MESSAGE ================= */

.section {

    background: #f7f4ed;

    padding: 18px;

    border-radius: 12px;

    margin-top: 15px;

}

.section-title {

    font-weight: bold;

    margin-bottom: 8px;

    color: #173c2d;

}

.section p {

    color: #555;

    line-height: 1.6;

}


/* ================= REPLY ================= */

.reply-box {

    margin-top: 20px;

    background: #edf6f1;

    border-left: 5px solid #173c2d;

    padding: 18px;

    border-radius: 10px;

}

.reply-title {

    font-weight: bold;

    margin-bottom: 8px;

    color: #173c2d;

}

.reply-box p {

    color: #444;

    line-height: 1.6;

}


/* ================= NO MESSAGES ================= */

.no-messages {

    background: white;

    padding: 40px;

    border-radius: 18px;

    text-align: center;

    box-shadow: 0 8px 25px rgba(0,0,0,0.08);

}

.no-messages i {

    font-size: 45px;

    margin-bottom: 15px;

    color: #173c2d;

}

.no-messages h2 {

    margin-bottom: 8px;

}

.no-messages p {

    color: #777;

}


/* ================= MOBILE ================= */

@media(max-width:700px) {

    .container {

        width: 94%;

        margin: 25px auto;

    }

    .top {

        align-items: flex-start;

        flex-direction: column;

        gap: 15px;

    }

    .message-top {

        flex-direction: column;

        align-items: flex-start;

    }

}

</style>

</head>


<body>


<div class="container">


    <div class="top">

        <div>

            <h1>
                My Messages
            </h1>

            <p class="subtitle">
                View your messages and replies from the PawConnect team.
            </p>

        </div>

        <a href="user_dashboard.php" class="back">
            <i class="fa-solid fa-arrow-left"></i>
            Dashboard
        </a>

    </div>


<?php

if ($result->num_rows == 0) {

?>

    <div class="no-messages">

        <i class="fa-regular fa-message"></i>

        <h2>
            No Messages Yet
        </h2>

        <p>
            You haven't sent any messages to PawConnect yet.
        </p>

    </div>

<?php

}

while ($row = $result->fetch_assoc()) {

    $has_reply = !empty(trim($row['reply'] ?? ''));

?>

    <div class="message-card">


        <div class="message-top">

            <div>

                <h2>
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

                    <span class="status pending">
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

        <div class="section">

            <div class="section-title">

                <i class="fa-regular fa-message"></i>

                Your Message

            </div>

            <p>

                <?php
                echo nl2br(
                    htmlspecialchars($row['message'])
                );
                ?>

            </p>

        </div>


        <!-- ADMIN REPLY -->

        <?php if ($has_reply) { ?>

            <div class="reply-box">

                <div class="reply-title">

                    <i class="fa-solid fa-reply"></i>

                    PawConnect Reply

                </div>

                <p>

                    <?php
                    echo nl2br(
                        htmlspecialchars($row['reply'])
                    );
                    ?>

                </p>

            </div>

        <?php } else { ?>

            <div class="reply-box">

                <div class="reply-title">

                    <i class="fa-solid fa-clock"></i>

                    Waiting for Reply

                </div>

                <p>
                    Your message has been received.
                    Our admin team will reply here on the website.
                </p>

            </div>

        <?php } ?>


    </div>

<?php

}

?>

</div>

</body>

</html>