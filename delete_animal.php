<?php

include "db.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid Animal ID");
}

$id = intval($_GET['id']);


/* GET IMAGE NAME */

$query = "SELECT image FROM animals WHERE id = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    die("Animal not found");
}

$animal = mysqli_fetch_assoc($result);


/* DELETE DATABASE RECORD */

$delete = "DELETE FROM animals WHERE id = $id";

if (mysqli_query($conn, $delete)) {

    /* DELETE IMAGE */

    if (!empty($animal['image'])) {

        $image_path = "uploads/animals/" . $animal['image'];

        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    header("Location: manage_animalsngo.php");
    exit();

} else {

    echo "Error deleting animal: " . mysqli_error($conn);
}

?>