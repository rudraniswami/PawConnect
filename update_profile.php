<?php

session_start();

include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    exit();
}

$id = $_SESSION['user_id'];

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$pincode = $_POST['pincode'];


$sql = "UPDATE users SET
        name='$name',
        email='$email',
        phone='$phone',
        address='$address',
        city='$city',
        state='$state',
        pincode='$pincode'
        WHERE id='$id'";

if (mysqli_query($conn, $sql)) {

    $_SESSION['user_name'] = $name;

    header("location: my_profile.php? success=1");

} else {

    echo "Profile update failed.";

}

?>