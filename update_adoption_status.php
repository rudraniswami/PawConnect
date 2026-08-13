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


/* ==========================================
   GET THE ANIMAL/PET THIS REQUEST IS FOR
   (needed before we update, so we know what
   else to update afterwards)
========================================== */

$stmt = $conn->prepare(
    "SELECT animal_id, pet_id FROM adoption_requests WHERE id = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$request_row = $stmt->get_result()->fetch_assoc();

if (!$request_row) {
    die("Adoption request not found.");
}

$request_animal_id = intval($request_row['animal_id']);
$request_pet_id = intval($request_row['pet_id']);


/* ==========================================
   UPDATE THIS REQUEST'S STATUS
========================================== */

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


if (!$stmt->execute()) {

    die("Error updating request: " . $stmt->error);

}


/* ==========================================
   IF APPROVED - HANDLE THE REST OF THE FLOW
========================================== */

if ($status == "Approved") {

    /* ----------------------------------------
       1. Mark the animal as Adopted
          (only for the "animals" table -
          the older "pets" table has no
          status column, so we skip it there)
    ---------------------------------------- */

    if ($request_animal_id > 0) {

        $update_animal = $conn->prepare(
            "UPDATE animals SET status = 'Adopted' WHERE id = ?"
        );
        $update_animal->bind_param("i", $request_animal_id);
        $update_animal->execute();

    }


    /* ----------------------------------------
       2. Auto-reject any OTHER pending
          requests for this same animal/pet.
          Tagged with a distinct status so the
          dashboard can show a friendlier
          message than a plain "Rejected".
    ---------------------------------------- */

    $auto_reject_status = "Rejected - Animal Adopted";

    if ($request_animal_id > 0) {

        $reject_others = $conn->prepare(
            "UPDATE adoption_requests
             SET status = ?
             WHERE animal_id = ?
             AND status = 'Pending'
             AND id != ?"
        );

        $reject_others->bind_param(
            "sii",
            $auto_reject_status,
            $request_animal_id,
            $id
        );

        $reject_others->execute();

    }
    elseif ($request_pet_id > 0) {

        $reject_others = $conn->prepare(
            "UPDATE adoption_requests
             SET status = ?
             WHERE pet_id = ?
             AND status = 'Pending'
             AND id != ?"
        );

        $reject_others->bind_param(
            "sii",
            $auto_reject_status,
            $request_pet_id,
            $id
        );

        $reject_others->execute();

    }

}


header("Location: admin_adoptions.php");
exit();

?>