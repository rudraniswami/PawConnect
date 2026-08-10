<?php

session_start();

include "db.php";

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM admin 
          WHERE email='$email' 
          AND password='$password'";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {

    $_SESSION['admin_email'] = $email;

    header("Location: admin_dashboard.php");
    exit();

} else {

    echo "<script>
            alert('Invalid Email or Password');
            window.location='admin_login.php';
          </script>";
}

?>