<?php
session_start();
include "ngodb.php";

$error = "";

// If already logged in, go straight to dashboard
if (isset($_SESSION["ngo_id"])) {
    header("Location: ngo_dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email    = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, name, password FROM ngos WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $ngo = $result->fetch_assoc();

        // Compare typed password with the hashed one saved in the database
        if (password_verify($password, $ngo["password"])) {
            $_SESSION["ngo_id"]   = $ngo["id"];
            $_SESSION["ngo_name"] = $ngo["name"];

            header("Location: ngo_dashboard.php");
            exit();
        } else {
            $error = "Incorrect email or password.";
        }
    } else {
        $error = "Incorrect email or password.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<title>NGO Login - PawConnect</title>
<link rel="stylesheet" href="ngo.css">
</head>
<body>

<div class="ngo-topbar">
    <div class="logo">
        <img src="logo.jpeg" alt="PawConnect Logo">
        <h2>PawConnect</h2>
    </div>
    <div class="topbar-links">
        <a href="home.html">Back to Home</a>
    </div>
</div>

<div class="auth-wrapper">
    <div class="auth-box">
        <h2>NGO Login</h2>
        <p class="auth-sub">Log in to manage your animals</p>

        <?php if ($error != "") { ?>
            <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
        <?php } ?>

        <form method="POST" action="ngo_login.php">

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="auth-btn">Login</button>

        </form>

        <div class="auth-switch">
            Don't have an account? <a href="ngo_register.php">Register your NGO</a>
        </div>
    </div>
</div>

</body>
</html>