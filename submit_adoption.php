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
   CHECK PET ID
========================================== */

if (!isset($_POST['pet_id']) || empty($_POST['pet_id'])) {

    die("No pet selected.");

}

$pet_id = intval($_POST['pet_id']);


/* ==========================================
   CHECK PET EXISTS
========================================== */

$check = $conn->prepare(
    "SELECT id FROM pets WHERE id = ?"
);

if (!$check) {

    die("Database error: " . $conn->error);

}

$check->bind_param("i", $pet_id);

$check->execute();

$result = $check->get_result();

if ($result->num_rows == 0) {

    die("Pet not found.");

}

$check->close();


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
   VALIDATION
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
   CHECK AGREEMENT
========================================== */

if (!isset($_POST['agreement'])) {

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
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
)";


$stmt = $conn->prepare($sql);


if (!$stmt) {

    die("Database error: " . $conn->error);

}


/* ==========================================
   BIND VALUES
========================================== */

$stmt->bind_param(
    "iissssssssssssss",
    $user_id,
    $pet_id,
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

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Adoption Request Submitted | PawConnect</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {

            margin: 0;

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            font-family: Arial, sans-serif;

            background: #f7f4ed;

        }


        .success-box {

            width: 90%;

            max-width: 520px;

            background: #ffffff;

            padding: 45px 35px;

            text-align: center;

            border-radius: 20px;

            box-shadow:
                0 15px 40px rgba(0,0,0,0.10);

        }


        .icon {

            width: 75px;

            height: 75px;

            margin: 0 auto 20px;

            display: flex;

            justify-content: center;

            align-items: center;

            background: #173c2d;

            color: white;

            border-radius: 50%;

            font-size: 38px;

        }


        h1 {

            margin: 0 0 15px;

            color: #173c2d;

            font-size: 30px;

        }


        p {

            color: #666;

            line-height: 1.7;

            font-size: 16px;

        }


        .status {

            display: inline-block;

            margin-top: 10px;

            padding: 8px 18px;

            border-radius: 20px;

            background: #f1ead9;

            color: #173c2d;

            font-weight: bold;

        }


        .btn {

            display: inline-block;

            margin-top: 25px;

            padding: 13px 28px;

            background: #173c2d;

            color: white;

            text-decoration: none;

            border-radius: 8px;

            font-weight: bold;

        }


        .btn:hover {

            background: #245541;

        }

    </style>

</head>


<body>


<div class="success-box">


    <div class="icon">

        🐾

    </div>


    <h1>

        Adoption Request Submitted!

    </h1>


    <p>

        Thank you for choosing to give a rescued animal

        a loving home.

    </p>


    <p>

        Your adoption request has been successfully

        submitted to the PawConnect team.

    </p>


    <div class="status">

        Status: Pending

    </div>


    <br>


    <a href="animals.php" class="btn">

        Back to Animals

    </a>


</div>


</body>

</html>

<?php

} else {

    die(
        "Error submitting adoption request: "
        . $stmt->error
    );

}


$stmt->close();

$conn->close();

?>