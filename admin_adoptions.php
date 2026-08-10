<?php

include "db.php";


/* ================================
   GET ADOPTION REQUESTS
================================ */

$sql = "SELECT 
            adoption_requests.*,
            animals.name AS animal_name,
            animals.image AS animal_image
        FROM adoption_requests
        LEFT JOIN animals
        ON adoption_requests.pet_id = animals.id
        ORDER BY adoption_requests.created_at DESC";


$result = mysqli_query($conn, $sql);


if (!$result) {
    die("Database error: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Adoption Requests | PawConnect Admin</title>

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


/* ================= NAVBAR ================= */

.nav {
    height: 75px;
    background: #173c2d;
    display: flex;
    align-items: center;
    padding: 0 55px;
    color: white;
}

.nav h2 {
    font-family: Georgia, serif;
}


/* ================= CONTAINER ================= */

.container {
    width: 1100px;
    max-width: 92%;
    margin: 50px auto;
}


.header {
    margin-bottom: 30px;
}

.header p {
    font-size: 12px;
    letter-spacing: 3px;
    font-weight: bold;
}

.header h1 {
    font-family: Georgia, serif;
    font-size: 42px;
    margin-top: 8px;
}

.header span {
    display: block;
    color: #718078;
    margin-top: 8px;
}


/* ================= CARD ================= */

.request-card {
    background: white;
    border-radius: 18px;
    padding: 22px;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 22px;
    box-shadow: 0 7px 25px rgba(23,60,45,0.07);
}


/* ================= PHOTO ================= */

.animal-photo {
    width: 100px;
    height: 100px;
    flex-shrink: 0;
}

.animal-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 15px;
}


/* ================= INFO ================= */

.request-info {
    flex: 1;
}

.request-info h2 {
    font-family: Georgia, serif;
    font-size: 25px;
    margin-bottom: 6px;
}

.request-info p {
    color: #69756e;
    font-size: 14px;
    margin-bottom: 5px;
}

.request-info strong {
    color: #173c2d;
}


/* ================= STATUS ================= */

.status {
    display: inline-block;
    padding: 6px 13px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    margin-top: 8px;
}

.status.Pending {
    background: #f4e7c5;
    color: #765d25;
}

.status.Approved {
    background: #dcefe4;
    color: #21623c;
}

.status.Rejected {
    background: #f5dada;
    color: #963c3c;
}


/* ================= BUTTONS ================= */

.actions {
    display: flex;
    flex-direction: column;
    gap: 9px;
    min-width: 145px;
}

.actions a {
    text-decoration: none;
    text-align: center;
    padding: 10px 15px;
    border-radius: 22px;
    font-size: 12px;
    font-weight: bold;
}


.view-btn {
    background: #173c2d;
    color: white;
}

.approve-btn {
    background: #dcefe4;
    color: #21623c;
}

.reject-btn {
    background: #f5dada;
    color: #963c3c;
}


/* ================= EMPTY ================= */

.empty {
    background: white;
    padding: 50px;
    text-align: center;
    border-radius: 18px;
    color: #777;
}


/* ================= MOBILE ================= */

@media(max-width: 750px) {

    .request-card {
        flex-direction: column;
        align-items: flex-start;
    }

    .actions {
        width: 100%;
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



<!-- ================= CONTENT ================= -->

<div class="container">


    <div class="header">

        <p>
            PAWCONNECT ADMIN
        </p>

        <h1>
            Adoption Requests
        </h1>

        <span>
            Review applications and manage adoption requests.
        </span>

    </div>



<?php if (mysqli_num_rows($result) > 0) { ?>


    <?php while ($row = mysqli_fetch_assoc($result)) { ?>


        <div class="request-card">


            <!-- ANIMAL PHOTO -->

            <div class="animal-photo">

                <?php if (!empty($row['animal_image'])) { ?>

                    <img
                        src="<?php echo htmlspecialchars($row['animal_image']); ?>"
                        alt="<?php echo htmlspecialchars($row['animal_name']); ?>">

                <?php } else { ?>

                    <img
                        src="logo.jpeg"
                        alt="PawConnect">

                <?php } ?>

            </div>



            <!-- REQUEST INFO -->

            <div class="request-info">

                <h2>

                    <?php

                    echo htmlspecialchars(
                        $row['animal_name'] ?? 'Unknown Animal'
                    );

                    ?>

                </h2>


                <p>

                    Applicant:
                    
                    <strong>
                        <?php echo htmlspecialchars($row['full_name']); ?>
                    </strong>

                </p>


                <p>

                    Email:
                    
                    <?php echo htmlspecialchars($row['email']); ?>

                </p>


                <p>

                    Request ID:
                    
                    #<?php echo htmlspecialchars($row['id']); ?>

                </p>


                <span class="status <?php echo htmlspecialchars($row['status']); ?>">

                    <?php echo htmlspecialchars($row['status']); ?>

                </span>

            </div>



            <!-- ACTIONS -->

            <div class="actions">


                <a
                    href="adoption_details.php?id=<?php echo $row['id']; ?>"
                    class="view-btn">

                    View Details

                </a>


                <?php if ($row['status'] != 'Approved') { ?>

                    <a
                        href="update_adoption_status.php?id=<?php echo $row['id']; ?>&status=Approved"
                        class="approve-btn"
                        onclick="return confirm('Approve this adoption request?');">

                        ✓ Approve

                    </a>

                <?php } ?>


                <?php if ($row['status'] != 'Rejected') { ?>

                    <a
                        href="update_adoption_status.php?id=<?php echo $row['id']; ?>&status=Rejected"
                        class="reject-btn"
                        onclick="return confirm('Reject this adoption request?');">

                        ✕ Reject

                    </a>

                <?php } ?>


            </div>


        </div>


    <?php } ?>


<?php } else { ?>


    <div class="empty">

        <h2>
            No Adoption Requests
        </h2>

        <p>
            There are currently no adoption applications.
        </p>

    </div>


<?php } ?>


</div>


</body>

</html>