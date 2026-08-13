<?php

session_start();
include "db.php";


/* =========================
   ADMIN LOGIN CHECK
========================= */

if (!isset($_SESSION['admin_id'])) {

    header("Location: admin_login.php");
    exit();

}


/* =========================
   SEND REPLY
========================= */

if (isset($_POST['send_reply'])) {

    $contact_id = intval($_POST['contact_id']);
    $reply = trim($_POST['reply']);


    if ($contact_id > 0 && $reply != "") {

        $stmt = $conn->prepare("
            UPDATE contact_messages
            SET reply = ?, reply_at = NOW()
            WHERE id = ?
        ");

        $stmt->bind_param(
            "si",
            $reply,
            $contact_id
        );

        $stmt->execute();

        $stmt->close();

    }

}


/* =========================
   GET CONTACT MESSAGES
========================= */

$sql = "
SELECT *
FROM contact_messages
ORDER BY id DESC
";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Contact Messages | PawConnect</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Times New Roman', Times, serif;
}

body{

    background:#FFFDF7;

    color:#123C2A;

}


.container{

    width:92%;

    max-width:1200px;

    margin:50px auto;

}


.header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:35px;

}


.header h1{

    font-size:42px;

}


.back-btn{

    text-decoration:none;

    background:#123C2A;

    color:white;

    padding:12px 22px;

    border-radius:30px;

    font-weight:bold;

}


.message-card{

    background:white;

    border-radius:25px;

    padding:30px;

    margin-bottom:25px;

    box-shadow:0 12px 35px rgba(18,60,42,.10);

}


.message-top{

    display:flex;

    justify-content:space-between;

    margin-bottom:20px;

}


.message-top h2{

    font-size:28px;

}


.date{

    color:#888;

    font-size:14px;

}


.details{

    display:grid;

    grid-template-columns:1fr 1fr;

    gap:10px;

    margin-bottom:20px;

}


.details p{

    color:#555;

}


.subject{

    color:#C6A15B !important;

    font-weight:bold;

}


.message{

    background:#F5EFE3;

    padding:20px;

    border-radius:15px;

    color:#444;

    line-height:1.7;

    margin-bottom:20px;

}


.reply-section{

    border-top:1px solid #eee;

    padding-top:20px;

}


.reply-section label{

    display:block;

    font-weight:bold;

    margin-bottom:10px;

}


.reply-section textarea{

    width:100%;

    min-height:120px;

    padding:15px;

    border:1px solid #ddd;

    border-radius:15px;

    resize:vertical;

    background:#FFFDF7;

    font-size:16px;

    outline:none;

}


.reply-section textarea:focus{

    border-color:#C6A15B;

}


.reply-btn{

    margin-top:12px;

    padding:12px 25px;

    border:none;

    border-radius:30px;

    background:#123C2A;

    color:white;

    font-weight:bold;

    cursor:pointer;

}


.reply-btn:hover{

    background:#1D6747;

}


.reply-done{

    background:#E2F1E5;

    padding:20px;

    border-radius:15px;

    color:#315C3D;

    line-height:1.6;

}


.reply-date{

    font-size:13px;

    color:#777;

}


@media(max-width:700px){

    .header{

        flex-direction:column;

        align-items:flex-start;

        gap:15px;

    }


    .header h1{

        font-size:34px;

    }


    .details{

        grid-template-columns:1fr;

    }


    .message-top{

        flex-direction:column;

        gap:8px;

    }

}

</style>

</head>


<body>


<div class="container">


    <div class="header">

        <h1>
            Contact Messages
        </h1>


        <a href="admin_dashboard.php"
           class="back-btn">

            ← Dashboard

        </a>

    </div>


<?php

if ($result->num_rows == 0) {

?>

    <div class="message-card">

        No contact messages yet.

    </div>

<?php

}


while ($row = $result->fetch_assoc()) {

?>


<div class="message-card">


    <div class="message-top">

        <h2>

            <?php echo htmlspecialchars($row['name']); ?>

        </h2>


        <span class="date">

            <?php echo htmlspecialchars($row['created_at']); ?>

        </span>

    </div>



    <div class="details">


        <p>

            <strong>Email:</strong>

            <?php echo htmlspecialchars($row['email']); ?>

        </p>


        <p>

            <strong>Phone:</strong>

            <?php echo htmlspecialchars($row['phone']); ?>

        </p>


        <p class="subject">

            Subject:

            <?php echo htmlspecialchars($row['subject']); ?>

        </p>


    </div>



    <div class="message">

        <?php

        echo nl2br(
            htmlspecialchars($row['message'])
        );

        ?>

    </div>



<?php if (!empty($row['reply'])) { ?>


    <!-- ALREADY REPLIED -->

    <div class="reply-done">

        <strong>
            Admin Reply
        </strong>

        <br><br>

        <?php

        echo nl2br(
            htmlspecialchars($row['reply'])
        );

        ?>


        <?php if (!empty($row['reply_at'])) { ?>

            <br><br>

            <span class="reply-date">

                Replied on:

                <?php

                echo htmlspecialchars(
                    $row['reply_at']
                );

                ?>

            </span>

        <?php } ?>


    </div>


<?php } else { ?>


    <!-- REPLY FORM -->

    <div class="reply-section">


        <form method="POST"
              action="admin_contact.php">


            <input type="hidden"
                   name="contact_id"
                   value="<?php echo $row['id']; ?>">


            <label>
                Reply to this message
            </label>


            <textarea
                name="reply"
                placeholder="Write your reply here..."
                required></textarea>


            <button type="submit"
                    name="send_reply"
                    class="reply-btn">

                Send Reply

            </button>


        </form>


    </div>


<?php } ?>


</div>


<?php

}

?>


</div>

</body>

</html>