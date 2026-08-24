<?php

session_start();
include "db.php";


/* ================================
   CHECK ADMIN LOGIN
================================ */

if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}


/* ================================
   CHECK ID
================================ */

if (!isset($_GET['id'])) {
    die("Animal ID is missing.");
}

$animal_id = (int)$_GET['id'];

if ($animal_id <= 0) {
    die("Invalid animal ID.");
}


/* ================================
   CHECK ANIMAL EXISTS
================================ */

$check = mysqli_prepare(
    $conn,
    "SELECT id, image FROM animals WHERE id = ?"
);

if (!$check) {
    die("Database error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $check,
    "i",
    $animal_id
);

mysqli_stmt_execute($check);

$result = mysqli_stmt_get_result($check);

if (mysqli_num_rows($result) == 0) {

    mysqli_stmt_close($check);

    die(
        "Animal not found. ID received: " .
        $animal_id
    );
}

$animal = mysqli_fetch_assoc($result);

$image = $animal['image'];

mysqli_stmt_close($check);



//    DELETE ANIMAL


$delete = mysqli_prepare(
    $conn,
    "DELETE FROM animals WHERE id = ?"
);

if (!$delete) {
    die("Database error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $delete,
    "i",
    $animal_id
);


if (!mysqli_stmt_execute($delete)) {

    $error = mysqli_stmt_error($delete);

    mysqli_stmt_close($delete);

    die(
        "Unable to delete animal: " .
        $error
    );
}

mysqli_stmt_close($delete);


//    DELETE IMAGE


if (!empty($image)) {

    $image_path = __DIR__ . "/" . $image;

    if (file_exists($image_path)) {
        unlink($image_path);
    }
}



//    RETURN TO ADMIN PAGE


header(
    "Location: manage_animalsadmin.php"
);

exit();

?>