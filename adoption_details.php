<?php

include "db.php";

/* ================================
   CHECK REQUEST ID
================================ */

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("No adoption request selected.");
}

$request_id = intval($_GET['id']);


/* ================================
   GET ADOPTION REQUEST
================================ */

$sql = "
SELECT
    ar.*,

    a.name AS animal_name,
    a.breed AS animal_breed,

    p.name AS old_pet_name,
    p.breed AS old_pet_breed

FROM adoption_requests ar

LEFT JOIN animals a
    ON ar.animal_id = a.id

LEFT JOIN pets p
    ON ar.pet_id = p.id

WHERE ar.id = ?
";

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


/* ================================
   FIND CORRECT ANIMAL
================================ */

if (
    isset($request['animal_id']) &&
    $request['animal_id'] > 0 &&
    !empty($request['animal_name'])
) {

    $animal_name = $request['animal_name'];
    $animal_breed = $request['animal_breed'];

} else {

    $animal_name = !empty($request['old_pet_name'])
        ? $request['old_pet_name']
        : "Unknown Animal";

    $animal_breed = $request['old_pet_breed'] ?? "";

}

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


/* ===============================
   STATUS COLORS
================================ */

.status-pending {

    background: #fff3cd;

    color: #856404;

}


.status-approved {

    background: #d4edda;

    color: #155724;

}


.status-rejected {

    background: #f8d7da;

    color: #721c24;

}


.status-completed {

    background: #dff3e5;

    color: #176b3a;

}


/* ===============================
   CURRENT STATUS
================================ */

.current-status {

    display: flex;

    align-items: center;

    gap: 15px;

    margin-bottom: 25px;

}


.status-label {

    font-size: 13px;

    color: #777;

    font-weight: bold;

}


/* ===============================
   ACTIONS
================================ */

.actions {

    display: flex;

    gap: 15px;

    margin-top: 25px;

    flex-wrap: wrap;

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


.complete {

    background: #c49a28;

    color: white;

}


.completed-message {

    background: #dff3e5;

    color: #176b3a;

    padding: 14px 20px;

    border-radius: 25px;

    font-weight: bold;

}


.completed-message i {

    margin-right: 8px;

}


.back {

    display: inline-block;

    margin-top: 25px;

    color: #173c2d;

    text-decoration: none;

    font-weight: bold;

}


.back:hover {

    text-decoration: underline;

}


@media(max-width:700px) {

    .info-grid {

        grid-template-columns: 1fr;

    }


    .actions {

        flex-direction: column;

    }


    .actions a {

        text-align: center;

    }


    .current-status {

        flex-direction: column;

        align-items: flex-start;

    }

}

</style>

</head>


<body>


<!-- ================= NAVBAR ================= -->

<div class="nav">

    <h2>
        PawConnect Admin
    </h2>

</div>


<div class="container">


    <!-- ================= HEADER ================= -->

    <div class="header">

        <p>
            PAWCONNECT ADMIN
        </p>

        <h1>
            Adoption Request
        </h1>

    </div>



    <!-- ================= REQUEST INFORMATION ================= -->

    <div class="card">

        <h2>
            Request Information
        </h2>


        <div class="info-grid">


            <div class="info">

                <small>
                    Request ID
                </small>

                <strong>

                    #<?php
                    echo htmlspecialchars(
                        $request['id']
                    );
                    ?>

                </strong>

            </div>



            <div class="info">

                <small>
                    Animal
                </small>

                <strong>

                    <?php
                    echo htmlspecialchars(
                        $animal_name
                    );
                    ?>

                    <?php
                    if (!empty($animal_breed)) {
                    ?>

                        (
                        <?php
                        echo htmlspecialchars(
                            $animal_breed
                        );
                        ?>
                        )

                    <?php } ?>

                </strong>

            </div>



            <div class="info">

                <small>
                    Status
                </small>

                <?php

                $current_status =
                    $request['status'];

                if ($current_status == "Approved") {

                    $status_class =
                        "status-approved";

                }
                elseif ($current_status == "Completed") {

                    $status_class =
                        "status-completed";

                }
                elseif (
                    strpos(
                        $current_status,
                        "Rejected"
                    ) === 0
                ) {

                    $status_class =
                        "status-rejected";

                }
                else {

                    $status_class =
                        "status-pending";

                }

                ?>

                <span class="status <?php echo $status_class; ?>">

                    <?php
                    echo htmlspecialchars(
                        $current_status
                    );
                    ?>

                </span>

            </div>



            <div class="info">

                <small>
                    Created At
                </small>

                <strong>

                    <?php
                    echo htmlspecialchars(
                        $request['created_at']
                    );
                    ?>

                </strong>

            </div>


        </div>

    </div>



    <!-- ================= APPLICANT ================= -->

    <div class="card">

        <h2>
            Applicant Details
        </h2>


        <div class="info-grid">


            <div class="info">

                <small>
                    Full Name
                </small>

                <strong>

                    <?php
                    echo htmlspecialchars(
                        $request['full_name']
                    );
                    ?>

                </strong>

            </div>



            <div class="info">

                <small>
                    Phone
                </small>

                <strong>

                    <?php
                    echo htmlspecialchars(
                        $request['phone']
                    );
                    ?>

                </strong>

            </div>



            <div class="info">

                <small>
                    Email
                </small>

                <strong>

                    <?php
                    echo htmlspecialchars(
                        $request['email']
                    );
                    ?>

                </strong>

            </div>


        </div>

    </div>



    <!-- ================= HOME DETAILS ================= -->

    <div class="card">

        <h2>
            Home Details
        </h2>


        <div class="info-grid">


            <div class="info">

                <small>
                    Home Type
                </small>

                <strong>

                    <?php
                    echo htmlspecialchars(
                        $request['home_type']
                    );
                    ?>

                </strong>

            </div>



            <div class="info">

                <small>
                    Owns Home
                </small>

                <strong>

                    <?php
                    echo htmlspecialchars(
                        $request['owns_home']
                    );
                    ?>

                </strong>

            </div>



            <div class="info">

                <small>
                    Pet Friendly
                </small>

                <strong>

                    <?php
                    echo htmlspecialchars(
                        $request['pet_friendly']
                    );
                    ?>

                </strong>

            </div>



            <div class="info">

                <small>
                    Other Pets
                </small>

                <strong>

                    <?php
                    echo htmlspecialchars(
                        $request['other_pets']
                    );
                    ?>

                </strong>

            </div>


        </div>

    </div>



    <!-- ================= CARE DETAILS ================= -->

    <div class="card">

        <h2>
            Time & Care
        </h2>


        <div class="info-grid">


            <div class="info">

                <small>
                    Time Available
                </small>

                <strong>

                    <?php
                    echo htmlspecialchars(
                        $request['time_available']
                    );
                    ?>

                </strong>

            </div>



            <div class="info">

                <small>
                    Caretaker
                </small>

                <strong>

                    <?php
                    echo htmlspecialchars(
                        $request['caretaker']
                    );
                    ?>

                </strong>

            </div>



            <div class="info">

                <small>
                    Previous Pet
                </small>

                <strong>

                    <?php
                    echo htmlspecialchars(
                        $request['previous_pet']
                    );
                    ?>

                </strong>

            </div>



            <div class="info">

                <small>
                    Monthly Budget
                </small>

                <strong>

                    <?php
                    echo htmlspecialchars(
                        $request['monthly_budget']
                    );
                    ?>

                </strong>

            </div>



            <div class="info">

                <small>
                    Ready For Expenses
                </small>

                <strong>

                    <?php
                    echo htmlspecialchars(
                        $request['ready_for_expenses']
                    );
                    ?>

                </strong>

            </div>


        </div>

    </div>



    <!-- ================= REASON ================= -->

    <div class="card">

        <h2>
            Why They Want To Adopt
        </h2>


        <div class="reason">

            <?php

            echo nl2br(
                htmlspecialchars(
                    $request['reason']
                )
            );

            ?>

        </div>

    </div>



    <!-- ================= ADMIN ACTION ================= -->

    <div class="card">

        <h2>
            Adoption Status
        </h2>


        <div class="current-status">

            <span class="status-label">
                Current Status:
            </span>


            <?php

            if ($current_status == "Approved") {

                $display_class =
                    "status-approved";

            }
            elseif ($current_status == "Completed") {

                $display_class =
                    "status-completed";

            }
            elseif (
                strpos(
                    $current_status,
                    "Rejected"
                ) === 0
            ) {

                $display_class =
                    "status-rejected";

            }
            else {

                $display_class =
                    "status-pending";

            }

            ?>


            <span class="status <?php echo $display_class; ?>">

                <?php
                echo htmlspecialchars(
                    $current_status
                );
                ?>

            </span>

        </div>



        <div class="actions">


            <!-- PENDING -->

            <?php
            if ($current_status == "Pending") {
            ?>

                <a
                    href="update_adoption_status.php?id=<?php echo $request['id']; ?>&status=Approved"
                    class="approve">

                    ✓ Approve Request

                </a>


                <a
                    href="update_adoption_status.php?id=<?php echo $request['id']; ?>&status=Rejected"
                    class="reject">

                    ✕ Reject Request

                </a>

            <?php
            }
            ?>



            <!-- APPROVED -->

            <?php
            if ($current_status == "Approved") {
            ?>

                <a
                    href="complete_adoption.php?id=<?php echo $request['id']; ?>"
                    class="complete">

                    🐾 Mark Adoption Completed

                </a>

            <?php
            }
            ?>



            <!-- COMPLETED -->

            <?php
            if ($current_status == "Completed") {
            ?>

                <div class="completed-message">

                    <i class="fa-solid fa-circle-check"></i>

                    Adoption Completed Successfully

                </div>

            <?php
            }
            ?>


        </div>



        <a
            href="admin_adoptions.php"
            class="back">

            ← Back to Adoption Requests

        </a>

    </div>


</div>

</body>

</html>