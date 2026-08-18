<?php

session_start();

/* Remove NGO session */
unset($_SESSION['ngo_id']);

/* If you have other NGO session data, remove it too */
unset($_SESSION['ngo_name']);
unset($_SESSION['ngo_email']);

/* Destroy the session */
session_destroy();

/* Redirect to NGO login page */
header("Location: ngo_login.php");
exit;

?>