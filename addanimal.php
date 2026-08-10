<?php
session_start();
include "ngodb.php";

// Protect this page: only logged-in NGOs can add animals
if (!isset($_SESSION["ngo_id"])) {
    header("Location: ngo_login.php");
    exit();
}

$ngo_id = $_SESSION["ngo_id"];
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name        = trim($_POST["name"]);
    $type        = trim($_POST["type"]);
    $breed       = trim($_POST["breed"]);
    $age         = trim($_POST["age"]);
    $location    = trim($_POST["location"]);
    $status      = trim($_POST["status"]);
    $description = trim($_POST["description"]);
    $image_name  = "default-pet.jpeg"; // fallback if no image uploaded

    // Handle image upload if a file was chosen
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $upload_dir = "uploads/";

        // Create the uploads folder if it does not exist yet
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Use a unique file name so images never overwrite each other
        $image_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_path = $upload_dir . $image_name;

        move_uploaded_file($_FILES["image"]["tmp_name"], $target_path);
        $image_name = $target_path;
    }

    $stmt = $conn->prepare("INSERT INTO animals (ngo_id, name, type, breed, age, location, image, status, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssss", $ngo_id, $name, $type, $breed, $age, $location, $image_name, $status, $description);

    if ($stmt->execute()) {
        $success = "Animal added successfully!";
    } else {
        $error = "Something went wrong. Please try again.";
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
<title>Add Animal - PawConnect</title>
<link rel="stylesheet" href="ngo.css">
</head>
<body>

<div class="ngo-topbar">
    <div class="logo">
        <img src="logo.jpeg" alt="PawConnect Logo">
        <h2>PawConnect</h2>
    </div>
    <div class="topbar-links">
        <a href="ngo_dashboard.php">Back to Dashboard</a>
        <a href="ngo_logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<div class="form-wrapper">
    <div class="form-card">
        <h2>Add a New Animal</h2>

        <?php if ($error != "") { ?>
            <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
        <?php } ?>

        <?php if ($success != "") { ?>
            <div class="success-msg"><?php echo htmlspecialchars($success); ?></div>
        <?php } ?>

        <form method="POST" action="addanimal.php" enctype="multipart/form-data">

            <div class="form-group">
                <label>Animal Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Type</label>
                    <select name="type" required>
                        <option value="Dog">Dog</option>
                        <option value="Cat">Cat</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Breed</label>
                    <input type="text" name="breed" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Age</label>
                    <input type="text" name="age" placeholder="e.g. 2 Years" required>
                </div>

                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" required>
                </div>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="Available">Available</option>
                    <option value="Adopted">Adopted</option>
                </select>
            </div>

            <div class="form-group">
                <label>Photo</label>
                <input type="file" name="image" accept="image/*">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" placeholder="Tell adopters about this animal's personality and needs"></textarea>
            </div>

            <button type="submit" class="auth-btn">Add Animal</button>

        </form>
    </div>
</div>

</body>
</html>