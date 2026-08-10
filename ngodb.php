<?php
/* =========================================================
   PawConnect - Database Connection
   Used by every NGO page. Keep this file safe, never share
   your real credentials publicly.
========================================================= */

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "pawconnect";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// If connection fails, stop everything and show a simple message
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>