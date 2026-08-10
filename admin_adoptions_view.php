<?php

session_start();
include "db.php";

if (!isset($_GET['id'])) {
    die("Request not found.");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM adoption_requests WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Adoption request not found.");
}

$request = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Adoption Request | PawConnect</title>

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: #f8f6ef;
    color: #173c2d;
}

.header {
    background: #173c2d;
    color: white;
    padding: 22px 6%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header h2 {
    font-size: 22px;
}

.back {
    color: #173c2d;
    background: #f4e7c5;
    text-decoration: none;
    padding: 10px 18px;
    border-radius: 22px;
    font-size: 13px;
    font-weight: bold;
}

.container {
    width: 900px;
    max-width: 90%;
    margin: 55px auto;
}

.heading {
    margin-bottom: 30px;
}

.heading p {
    font-size: 11px;
    letter-spacing: 3px;
    font-weight: bold;
}

.heading h1 {
    font-family: Georgia, serif;
    font-size: 42px;
    margin-top: 8px;
}

.card {
    background: #fffdf7;
    padding: 30px;
    border-radius: 20px;
    margin-bottom: 20px;
    box-shadow: 0 8px 25px rgba(23,60,45,.07);
}

.card h2 {
    font-family: Georgia, serif;
    margin-bottom: 22px;
}

.grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.item small {
    display: block;
    color: #7b847f;
    font-size: 11px;
    margin-bottom: 6px;
    letter-spacing: 1px;
}

.item strong {
    font-size: 15px;
}

.full {
    grid-column: 1 / -1;
}

.message {
    line-height: 1.7;
    color: #536159;
}

.status {
    display: inline-block;
    padding: 8px 15px;
    border-radius: 20px;
    background: #eeeade;
    font-size: 13px;
    font-weight: bold;
}

@media(max-width:700px) {

    .grid {
        grid-template-columns: 1fr;
    }

    .full {
        grid-column: auto;
    }

    .heading h1 {
        font-size: 32px;
    }

}

</style>

</head>

<body>


<div class="header">

    <h2>PawConnect Admin</h2>

    <a href="admin_adoptions.php" class="back">
        <i class="fa-solid fa-arrow-left"></i>
        Back to Requests
    </a>

</div>


<div class="container">


<div class="heading">

    <p>ADOPTION APPLICATION</p>

    <h1>
        Request #<?php echo $request['id']; ?>
    </h1>

</div>


<!-- BASIC INFORMATION -->

<div class="card">

    <h2>Applicant Information</h2>

    <div class="grid">

        <div class="item">
            <small>FULL NAME</small>
            <strong>
                <?php echo htmlspecialchars($request['full_name']); ?>
            </strong>
        </div>

        <div class="item">
            <small>PHONE</small>
            <strong>
                <?php echo htmlspecialchars($request['phone']); ?>
            </strong>
        </div>

        <div class="item">
            <small>EMAIL</small>
            <strong>
                <?php echo htmlspecialchars($request['email']); ?>
            </strong>
        </div>

        <div class="item">
            <small>PET ID</small>
            <strong>
                <?php echo htmlspecialchars($request['pet_id']); ?>
            </strong>
        </div>

    </div>

</div>


<!-- HOME -->

<div class="card">

    <h2>Home & Lifestyle</h2>

    <div class="grid">

        <div class="item">
            <small>HOME TYPE</small>
            <strong>
                <?php echo htmlspecialchars($request['home_type']); ?>
            </strong>
        </div>

        <div class="item">
            <small>OWNS HOME</small>
            <strong>
                <?php echo htmlspecialchars($request['owns_home']); ?>
            </strong>
        </div>

        <div class="item">
            <small>PET FRIENDLY</small>
            <strong>
                <?php echo htmlspecialchars($request['pet_friendly']); ?>
            </strong>
        </div>

        <div class="item">
            <small>OTHER PETS</small>
            <strong>
                <?php echo htmlspecialchars($request['other_pets']); ?>
            </strong>
        </div>

    </div>

</div>


<!-- CARE -->

<div class="card">

    <h2>Pet Care</h2>

    <div class="grid">

        <div class="item">
            <small>TIME AVAILABLE</small>
            <strong>
                <?php echo htmlspecialchars($request['time_available']); ?>
            </strong>
        </div>

        <div class="item">
            <small>CARETAKER</small>
            <strong>
                <?php echo htmlspecialchars($request['caretaker']); ?>
            </strong>
        </div>

        <div class="item">
            <small>PREVIOUS PET</small>
            <strong>
                <?php echo htmlspecialchars($request['previous_pet']); ?>
            </strong>
        </div>

        <div class="item">
            <small>MONTHLY BUDGET</small>
            <strong>
                <?php echo htmlspecialchars($request['monthly_budget']); ?>
            </strong>
        </div>

        <div class="item full">
            <small>READY FOR EXPENSES</small>
            <strong>
                <?php echo htmlspecialchars($request['ready_for_expenses']); ?>
            </strong>
        </div>

    </div>

</div>


<!-- REASON -->

<div class="card">

    <h2>Why They Want To Adopt</h2>

    <p class="message">
        <?php echo nl2br(htmlspecialchars($request['reason'])); ?>
    </p>

</div>


<!-- STATUS -->

<div class="card">

    <h2>Application Status</h2>

    <span class="status">
        <?php echo htmlspecialchars($request['status']); ?>
    </span>

</div>


</div>

</body>

</html>