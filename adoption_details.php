<?php

include "db.php";

/* ================================
   CHECK REQUEST ID
================================ */

if (!isset($_GET['id'])) {
    die("No adoption request selected.");
}

$request_id = intval($_GET['id']);


/* ================================
   GET ADOPTION REQUEST
================================ */

$sql = "SELECT * FROM adoption_requests WHERE id = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("i", $request_id);
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

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: #f6f4ed;
    color: #173c2d;
}

.nav {
    height: 75px;
    background: #173c2d;
    display: flex;
    align-items: center;
    padding: 0 50px;
    color: white;
}

.nav h2 {
    font-family: Georgia, serif;
}

.container {
    width: 900px;
    max-width: 92%;
    margin: 50px auto;
}

.header {
    margin-bottom: 30px;
}

.header p {
    font-size: 12px;
    letter-spacing: 2px;
    font-weight: bold;
}

.header h1 {
    font-family: Georgia, serif;
    font-size: 40px;
    margin-top: 8px;
}

.card {
    background: white;
    border-radius: 18px;
    padding: 30px;
    margin-bottom: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.07);
}

.card h2 {
    font-family: Georgia, serif;
    margin-bottom: 20px;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}

.info {
    background: #f8f6ef;
    padding: 15px;
    border-radius: 10px;
}

.info small {
    display: block;
    color: #777;
    font-size: 11px;
    margin-bottom: 6px;
    text-transform: uppercase;
}

.info strong {
    font-size: 14px;
}

.reason {
    background: #f8f6ef;
    padding: 18px;
    border-radius: 10px;
    line-height: 1.6;
}

.status {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 20px;
    background: #eee;
    font-size: 13px;
    font-weight: bold;
}

.actions {
    display: flex;
    gap: 15px;
    margin-top: 25px;
}

.actions a {
    text-decoration: none;
    padding: 13px 25px;
    border-radius: 25px;
    font-weight: bold;
    font-size: 14px;
}

.approve {
    background: #173c2d;
    color: white;
}

.reject {
    background: #b94a48;
    color: white;
}

.back {
    display: inline-block;
    margin-top: 25px;
    color: #173c2d;
    text-decoration: none;
    font-weight: bold;
}

@media(max-width:700px) {

    .info-grid {
        grid-template-columns: 1fr;
    }

    .actions {
        flex-direction: column;
    }

}

</style>

</head>

<body>


<div class="nav">

    <h2>
        PawConnect Admin
    </h2>

</div>


<div class="container">


    <div class="header">

        <p>PAWCONNECT ADMIN</p>

        <h1>
            Adoption Request
        </h1>

    </div>



    <!-- REQUEST INFORMATION -->

    <div class="card">

        <h2>
            Request Information
        </h2>

        <div class="info-grid">

            <div class="info">

                <small>Request ID</small>

                <strong>
                    #<?php echo $request['id']; ?>
                </strong>

            </div>


            <div class="info">

                <small>Pet ID</small>

                <strong>
                    <?php echo htmlspecialchars($request['pet_id']); ?>
                </strong>

            </div>


            <div class="info">

                <small>Status</small>

                <span class="status">
                    <?php echo htmlspecialchars($request['status']); ?>
                </span>

            </div>


            <div class="info">

                <small>Created At</small>

                <strong>
                    <?php echo htmlspecialchars($request['created_at']); ?>
                </strong>

            </div>

        </div>

    </div>



    <!-- APPLICANT -->

    <div class="card">

        <h2>
            Applicant Details
        </h2>

        <div class="info-grid">

            <div class="info">

                <small>Full Name</small>

                <strong>
                    <?php echo htmlspecialchars($request['full_name']); ?>
                </strong>

            </div>


            <div class="info">

                <small>Phone</small>

                <strong>
                    <?php echo htmlspecialchars($request['phone']); ?>
                </strong>

            </div>


            <div class="info">

                <small>Email</small>

                <strong>
                    <?php echo htmlspecialchars($request['email']); ?>
                </strong>

            </div>


        </div>

    </div>



    <!-- HOME -->

    <div class="card">

        <h2>
            Home Details
        </h2>

        <div class="info-grid">

            <div class="info">

                <small>Home Type</small>

                <strong>
                    <?php echo htmlspecialchars($request['home_type']); ?>
                </strong>

            </div>


            <div class="info">

                <small>Owns Home</small>

                <strong>
                    <?php echo htmlspecialchars($request['owns_home']); ?>
                </strong>

            </div>


            <div class="info">

                <small>Pet Friendly</small>

                <strong>
                    <?php echo htmlspecialchars($request['pet_friendly']); ?>
                </strong>

            </div>


            <div class="info">

                <small>Other Pets</small>

                <strong>
                    <?php echo htmlspecialchars($request['other_pets']); ?>
                </strong>

            </div>

        </div>

    </div>



    <!-- CARE -->

    <div class="card">

        <h2>
            Time & Care
        </h2>

        <div class="info-grid">

            <div class="info">

                <small>Time Available</small>

                <strong>
                    <?php echo htmlspecialchars($request['time_available']); ?>
                </strong>

            </div>


            <div class="info">

                <small>Caretaker</small>

                <strong>
                    <?php echo htmlspecialchars($request['caretaker']); ?>
                </strong>

            </div>


            <div class="info">

                <small>Previous Pet</small>

                <strong>
                    <?php echo htmlspecialchars($request['previous_pet']); ?>
                </strong>

            </div>


            <div class="info">

                <small>Monthly Budget</small>

                <strong>
                    <?php echo htmlspecialchars($request['monthly_budget']); ?>
                </strong>

            </div>


            <div class="info">

                <small>Ready For Expenses</small>

                <strong>
                    <?php echo htmlspecialchars($request['ready_for_expenses']); ?>
                </strong>

            </div>

        </div>

    </div>



    <!-- REASON -->

    <div class="card">

        <h2>
            Why They Want To Adopt
        </h2>

        <div class="reason">

            <?php echo nl2br(
                htmlspecialchars($request['reason'])
            ); ?>

        </div>

    </div>



    <!-- ACTIONS -->

    <div class="card">

        <h2>
            Admin Decision
        </h2>

        <div class="actions">

            <a
                href="update_adoption_status.php?id=<?php echo $request['id']; ?>&status=Approved"
                class="approve"
                onclick="return confirm('Approve this adoption request?');">

                ✓ Approve Request

            </a>


            <a
                href="update_adoption_status.php?id=<?php echo $request['id']; ?>&status=Rejected"
                class="reject"
                onclick="return confirm('Reject this adoption request?');">

                ✕ Reject Request

            </a>

        </div>

        <a href="admin_adoptions.php" class="back">
            ← Back to Adoption Requests
        </a>

    </div>


</div>

</body>

</html>