<?php

session_start();
include "db.php";


/* ==========================================
   CHECK LOGIN
========================================== */

if (!isset($_SESSION['user_id'])) {

    die("Please login first.");

}

$user_id = intval($_SESSION['user_id']);


/* ==========================================
   CHECK PET / ANIMAL
========================================== */

$pet_id = 0;
$animal_id = 0;


/* ------------------------------------------
   NEW ANIMAL
------------------------------------------ */

if (isset($_POST['animal_id']) && !empty($_POST['animal_id'])) {

    $animal_id = intval($_POST['animal_id']);

    $check = $conn->prepare(
        "SELECT id FROM animals WHERE id = ?"
    );

    if (!$check) {
        die("Database error: " . $conn->error);
    }

    $check->bind_param("i", $animal_id);
    $check->execute();

    $check_result = $check->get_result();

    if ($check_result->num_rows == 0) {

        die("Animal not found.");

    }

}


/* ------------------------------------------
   OLD PET
------------------------------------------ */

elseif (isset($_POST['pet_id']) && !empty($_POST['pet_id'])) {

    $pet_id = intval($_POST['pet_id']);

    $check = $conn->prepare(
        "SELECT id FROM pets WHERE id = ?"
    );

    if (!$check) {
        die("Database error: " . $conn->error);
    }

    $check->bind_param("i", $pet_id);
    $check->execute();

    $check_result = $check->get_result();

    if ($check_result->num_rows == 0) {

        die("Pet not found.");

    }

}


/* ------------------------------------------
   NOTHING SELECTED
------------------------------------------ */

else {

    die("No animal selected.");

}


/* ==========================================
   GET FORM DATA
========================================== */

$full_name = trim($_POST['full_name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');

$home_type = trim($_POST['home_type'] ?? '');
$owns_home = trim($_POST['owns_home'] ?? '');
$pet_friendly = trim($_POST['pet_friendly'] ?? '');
$other_pets = trim($_POST['other_pets'] ?? '');

$time_available = trim($_POST['time_available'] ?? '');
$caretaker = trim($_POST['caretaker'] ?? '');
$previous_pet = trim($_POST['previous_pet'] ?? '');

$monthly_budget = trim($_POST['monthly_budget'] ?? '');
$ready_for_expenses = trim($_POST['ready_for_expenses'] ?? '');

$reason = trim($_POST['reason'] ?? '');


/* ==========================================
   BASIC VALIDATION
========================================== */

if (
    $full_name == '' ||
    $phone == '' ||
    $email == '' ||
    $home_type == '' ||
    $owns_home == '' ||
    $pet_friendly == '' ||
    $other_pets == '' ||
    $time_available == '' ||
    $previous_pet == '' ||
    $monthly_budget == '' ||
    $ready_for_expenses == '' ||
    $reason == ''
) {

    die("Please fill all required fields.");

}


/* ==========================================
   AGREEMENT
========================================== */

$agreement = isset($_POST['agreement']) ? 1 : 0;

if ($agreement != 1) {

    die("Please accept the adoption agreement.");

}


/* ==========================================
   STATUS
========================================== */

$status = "Pending";


/* ==========================================
   INSERT ADOPTION REQUEST
========================================== */

$sql = "INSERT INTO adoption_requests
(
    user_id,
    pet_id,
    animal_id,
    full_name,
    phone,
    email,
    home_type,
    owns_home,
    pet_friendly,
    other_pets,
    time_available,
    caretaker,
    previous_pet,
    monthly_budget,
    ready_for_expenses,
    reason,
    status
)
VALUES
(
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
)";


$stmt = $conn->prepare($sql);


if (!$stmt) {

    die("Database error: " . $conn->error);

}


/*
   3 integers:
   user_id
   pet_id
   animal_id

   Then 14 strings.
*/

$stmt->bind_param(
    "iiissssssssssssss",
    $user_id,
    $pet_id,
    $animal_id,
    $full_name,
    $phone,
    $email,
    $home_type,
    $owns_home,
    $pet_friendly,
    $other_pets,
    $time_available,
    $caretaker,
    $previous_pet,
    $monthly_budget,
    $ready_for_expenses,
    $reason,
    $status
);


/* ==========================================
   EXECUTE
========================================== */

if ($stmt->execute()) {

    echo "
    <!DOCTYPE html>
    <html>
    <head>

        <meta charset='UTF-8'>

        <title>Adoption Request Submitted</title>

        <style>

            body {
                font-family: Arial, sans-serif;
                background: #f7f4ed;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
            }

            .box {
                background: white;
                padding: 45px;
                border-radius: 18px;
                text-align: center;
                width: 90%;
                max-width: 500px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.10);
            }

            .icon {
                font-size: 50px;
                margin-bottom: 15px;
            }

            h1 {
                color: #173c2d;
                margin-bottom: 10px;
            }

            p {
                color: #666;
                line-height: 1.6;
            }

            a {
                display: inline-block;
                margin-top: 20px;
                padding: 12px 25px;
                background: #173c2d;
                color: white;
                text-decoration: none;
                border-radius: 8px;
            }

        </style>

    </head>

    <body>

        <div class='box'>

            <div class='icon'>🐾</div>

            <h1>Request Submitted!</h1>

            <p>
                Your adoption request has been submitted successfully.
                Our team will review your application.
            </p>

            <a href='animals.php'>
                Back to Animals
            </a>

        </div>

    </body>
    </html>
    ";

} else {

    die(
        "Error submitting adoption request: "
        . $stmt->error
    );
}


$stmt->close();

$conn->close();

?>