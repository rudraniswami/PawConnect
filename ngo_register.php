<?php
// Start session so we can log the NGO in right after registering
session_start();
include "db.php";

$error = "";

// This block only runs when the form is submitted (POST request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form values safely
    $name    = trim($_POST["name"]);
    $email   = trim($_POST["email"]);
    $phone   = trim($_POST["phone"]);
    $address = trim($_POST["address"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check if email already exists
        $check = $conn->prepare("SELECT id FROM ngos WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "An NGO with this email already exists.";
        } else {
            // Hash the password before saving (never store plain passwords)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert = $conn->prepare("INSERT INTO ngos (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)");
            $insert->bind_param("sssss", $name, $email, $hashed_password, $phone, $address);

            if ($insert->execute()) {
                // Log the NGO in immediately after registering
                $_SESSION["ngo_id"]   = $insert->insert_id;
                $_SESSION["ngo_name"] = $name;

                header("Location: ngo_dashboard.php");
                exit();
            } else {
                $error = "Something went wrong. Please try again.";
            }
            $insert->close();
        }
        $check->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<title>NGO Registration - PawConnect</title>
<link rel="stylesheet" href="ngo.css">
</head>
<body>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="main-nav">

    <div class="main-nav-logo">

        <img src="logo.jpeg" alt="PawConnect Logo">

        <h2>PawConnect</h2>

    </div>


    <div class="main-nav-menu">

        <a href="home.php">
            HOME
        </a>


        <a href="about.php">
            ABOUT US
        </a>


        <div class="main-nav-dropdown">

            <a href="#">
                EXPLORE
                <i class="fa-solid fa-chevron-down"></i>
            </a>


            <div class="main-nav-dropdown-content">


                <!-- ABOUT -->

                <div class="main-nav-column">

                    <h3>
                        About
                    </h3>

                    <a href="about.php">
                        About Us
                    </a>

                    <a href="mission.php">
                        Mission
                    </a>

                    <a href="contact.php">
                        Contact
                    </a>

                </div>


                <!-- ADOPTION -->

                <div class="main-nav-column">

                    <h3>
                        Adoption
                    </h3>

                    <a href="animals.php">
                        Available Animals
                    </a>

                    <a href="care.php">
                        Care After Adoption
                    </a>

                    <a href="stories.php">
                        Adoption Stories
                    </a>

                </div>


                <!-- LOGIN -->

                <div class="main-nav-column">

                    <h3>
                        Login
                    </h3>

                    <a href="login.php">
                        User Login
                    </a>

                    <a href="ngo_login.php">
                        NGO Login
                    </a>

                    <a href="admin_login.php">
                        Admin Login
                    </a>

                </div>


            </div>

        </div>


        <a href="animals.php">
            ANIMALS
        </a>


        <!-- DASHBOARD -->

        <a href="<?php
            echo isset($_SESSION['user_id'])
                ? 'user_dashboard.php'
                : 'login.php';
        ?>">
            DASHBOARD
        </a>

    </div>


    <!-- LOGOUT -->

    <?php if (isset($_SESSION['user_id'])) { ?>

        <a href="logout.php" class="login-btn">
            LOGOUT
        </a>

    <?php } ?>


</div>

<div class="auth-wrapper">
    <div class="auth-box">
        <h2>NGO Registration</h2>
        <p class="auth-sub">Partner with PawConnect to help animals find homes</p>

        <?php if ($error != "") { ?>
            <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
        <?php } ?>

        <form method="POST" action="ngo_register.php">

            <div class="form-group">
                <label>NGO Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" required>
            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea name="address" required></textarea>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required>
            </div>

            <button type="submit" class="auth-btn">Register NGO</button>

        </form>

        <div class="auth-switch">
            Already registered? <a href="ngo_login.php">Login here</a>
        </div>
    </div>
</div>

</body>
</html>