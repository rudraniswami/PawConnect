<?php

session_start();
include "db.php";


/* ================================
   CHECK LOGIN
================================ */

if (!isset($_SESSION['user_id'])) {
    die("Please login first.");
}

$user_id = $_SESSION['user_id'];


/* ================================
   GET FORM DATA
================================ */

$pet_id = intval($_POST['pet_id']);

$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$home_type = $_POST['home_type'];
$owns_home = $_POST['owns_home'];
$pet_friendly = $_POST['pet_friendly'];
$other_pets = $_POST['other_pets'];

$time_available = $_POST['time_available'];
$caretaker = $_POST['caretaker'];
$previous_pet = $_POST['previous_pet'];

$monthly_budget = $_POST['monthly_budget'];
$ready_for_expenses = $_POST['ready_for_expenses'];

$reason = $_POST['reason'];


/* ================================
   DEFAULT STATUS
================================ */

$status = "Pending";


/* ================================
   INSERT REQUEST
================================ */

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
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


$stmt = $conn->prepare($sql);


if (!$stmt) {
    die("Database error: " . $conn->error);
}


/* 
   2 integers + 14 strings
*/

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


/* ================================
   EXECUTE
================================ */

if ($stmt->execute()) {

    echo "
    <script>
        alert('Your adoption request has been submitted successfully!');
        window.location.href = 'animals.php';
    </script>
    ";

} else {

    die("Error submitting request: " . $stmt->error);

}

?>