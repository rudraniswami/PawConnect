<?php

include "db.php";


if (!isset($_GET['id']) || !isset($_GET['status'])) {
    die("Invalid request.");
}


$id = intval($_GET['id']);
$status = $_GET['status'];


if ($status != "Approved" && $status != "Rejected") {
    die("Invalid status.");
}


$stmt = $conn->prepare(
    "UPDATE adoption_requests
     SET status = ?
     WHERE id = ?"
);


$stmt->bind_param(
    "si",
    $status,
    $id
);


if ($stmt->execute()) {

    header("Location: admin_adoptions.php");
    exit();

} else {

    die("Error updating request: " . $stmt->error);
}

?>