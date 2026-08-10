<?php

include "db.php";

/* GET MESSAGE ID */

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid message ID.");
}

$id = intval($_GET['id']);


/* DELETE MESSAGE */

$query = "DELETE FROM contact_messages WHERE id = $id";

if (mysqli_query($conn, $query)) {

    header("Location: admin-dashboard.php");
    exit;

} else {

    die("Error deleting message: " . mysqli_error($conn));

}

?>