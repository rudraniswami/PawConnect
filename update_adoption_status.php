<?php

include "db.php";


/* ================================
   CHECK DATA
================================ */

if (!isset($_GET['id']) || !isset($_GET['status'])) {

    die("Invalid request.");

}


$id = intval($_GET['id']);

$status = $_GET['status'];


/* ================================
   ALLOWED STATUS
================================ */

if ($status != "Approved" && $status != "Rejected") {

    die("Invalid status.");

}


/* ================================
   UPDATE STATUS
================================ */

$sql = "UPDATE adoption_requests
        SET status = ?
        WHERE id = ?";


$stmt = $conn->prepare($sql);

if (!$stmt) {

    die("Database error: " . $conn->error);

}


$stmt->bind_param(
    "si",
    $status,
    $id
);


if ($stmt->execute()) {

    header("Location: adoption_details.php?id=" . $id);

    exit();

} else {

    echo "Unable to update request.";

}

?>