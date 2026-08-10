<?php
session_start();
include "db.php";

// Protect this page: only logged-in NGOs can see it
if (!isset($_SESSION["ngo_id"])) {
    header("Location: ngo_login.php");
    exit();
}

$ngo_id = $_SESSION["ngo_id"];

// Get all animals added by this NGO
$stmt = $conn->prepare("SELECT * FROM animals WHERE ngo_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $ngo_id);
$stmt->execute();
$animals = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<title>NGO Dashboard - PawConnect</title>
<link rel="stylesheet" href="ngo.css">
</head>
<body>

<div class="ngo-topbar">
    <div class="logo">
        <img src="logo.jpeg" alt="PawConnect Logo">
        <h2>PawConnect</h2>
    </div>
    <div class="topbar-links">
        <span style="color:#FFFDF7;">Welcome, <?php echo htmlspecialchars($_SESSION["ngo_name"]); ?></span>
        <a href="ngo_logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<div class="dashboard-wrapper">

    <div class="dashboard-header">
        <div>
            <h1>Your Animals</h1>
            <p>Manage the animals your NGO has listed on PawConnect.</p>
        </div>
        <a href="addanimal.php" class="add-animal-btn">
            <i class="fa-solid fa-plus"></i> Add Animal
        </a>
    </div>

    <?php if ($animals->num_rows > 0) { ?>

        <table class="animal-table">
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Type</th>
                <th>Breed</th>
                <th>Age</th>
                <th>Location</th>
                <th>Status</th>
            </tr>

            <?php while ($animal = $animals->fetch_assoc()) { ?>
                <tr>
                    <td><img src="<?php echo htmlspecialchars($animal['image']); ?>" alt="<?php echo htmlspecialchars($animal['name']); ?>"></td>
                    <td><?php echo htmlspecialchars($animal['name']); ?></td>
                    <td><?php echo htmlspecialchars($animal['type']); ?></td>
                    <td><?php echo htmlspecialchars($animal['breed']); ?></td>
                    <td><?php echo htmlspecialchars($animal['age']); ?></td>
                    <td><?php echo htmlspecialchars($animal['location']); ?></td>
                    <td>
                        <?php if ($animal['status'] == "Available") { ?>
                            <span class="status-tag status-available">Available</span>
                        <?php } else { ?>
                            <span class="status-tag status-adopted">Adopted</span>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>

        </table>

    <?php } else { ?>

        <div class="no-animals">
            <p>You haven't added any animals yet.</p>
        </div>

    <?php } ?>

</div>

</body>
</html>