<?php

include "db.php";

/* GET MESSAGE ID */

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid message ID.");
}

$id = intval($_GET['id']);


/* UPDATE STATUS */

$query = "UPDATE contact_messages
          SET status = 'Read'
          WHERE id = $id";

if (mysqli_query($conn, $query)) {

    header("Location: view_message.php?id=" . $id);
    exit;

} else {

    die("Error updating message: " . mysqli_error($conn));

}

?>