<?php

include "db.php";


/* ==========================================
   GET ADOPTION REQUESTS
========================================== */

$sql = "
SELECT
    ar.*,

    a.name AS animal_name,
    a.image AS animal_image,
    a.breed AS animal_breed,

    p.name AS old_pet_name,
    p.image AS old_pet_image,
    p.breed AS old_pet_breed

FROM adoption_requests ar

LEFT JOIN animals a
    ON ar.animal_id = a.id

LEFT JOIN pets p
    ON ar.pet_id = p.id

ORDER BY ar.created_at DESC
";


$result = mysqli_query($conn, $sql);


if (!$result) {
    die("Database Error: " . mysqli_error($conn));
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Adoption Requests | PawConnect</title>


<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


body {

    font-family: Arial, sans-serif;

    background: #f7f4ed;

    color: #173c2d;

}


.container {

    width: 92%;

    max-width: 1200px;

    margin: 50px auto;

}


h1 {

    margin-bottom: 10px;

}


.subtitle {

    color: #777;

    margin-bottom: 30px;

}
.back-btn{
    text-decoration:none;
    color:#123C2A;
    font-weight:bold;
    display:flex;
    align-items:center;
    gap:8px;
}

.back-btn:hover{
    color:#C6A15B;
}



.request-card {

    background: white;

    border-radius: 15px;

    padding: 20px;

    margin-bottom: 20px;

    display: flex;

    gap: 20px;

    align-items: center;

    box-shadow: 0 5px 20px rgba(0,0,0,0.08);

}


.pet-image {

    width: 130px;

    height: 130px;

    object-fit: cover;

    border-radius: 12px;

}


.info {

    flex: 1;

}


.info h2 {

    margin-bottom: 6px;

}


.info p {

    margin: 5px 0;

    color: #555;

}


.status {

    display: inline-block;

    padding: 6px 12px;

    border-radius: 20px;

    margin-top: 8px;

    font-size: 13px;

    font-weight: bold;

}


.pending {

    background: #fff3cd;

    color: #856404;

}


.approved {

    background: #d4edda;

    color: #155724;

}


.rejected {

    background: #f8d7da;

    color: #721c24;

}


.buttons {

    display: flex;

    flex-direction: column;

    gap: 8px;

}


.buttons a {

    text-decoration: none;

    padding: 10px 16px;

    border-radius: 7px;

    text-align: center;

    color: white;

    font-size: 14px;

}


.view {

    background: #173c2d;

}


.approve {

    background: #4d8b62;

}


.reject {

    background: #c94c4c;

}


.no-data {

    background: white;

    padding: 30px;

    border-radius: 15px;

    text-align: center;

}


@media (max-width: 700px) {

    .request-card {

        flex-direction: column;

        align-items: flex-start;

    }


    .buttons {

        width: 100%;

    }

}

</style>

</head>


<body>


<div class="container">


    <h1>
        Adoption Requests
    </h1>


    <p class="subtitle">
        Review and manage PawConnect adoption applications.
    </p>

    <a href="admin_dashboard.php"
           class="back-btn">

            <i class="fa-solid fa-arrow-right"></i>

            Back to Dashboard

        </a>


<?php


if (mysqli_num_rows($result) == 0) {


    echo '

    <div class="no-data">

        No adoption requests found.

    </div>

    ';


}


while ($row = mysqli_fetch_assoc($result)) {


    /* ==========================================
       FIND CORRECT ANIMAL
    ========================================== */


    if (
        isset($row['animal_id']) &&
        $row['animal_id'] > 0 &&
        !empty($row['animal_name'])
    ) {


        /* NEW ANIMAL */

        $animal_name = $row['animal_name'];

        $animal_image = $row['animal_image'];

        $animal_breed = $row['animal_breed'];


    } else {


        /* OLD PET */

        $animal_name = !empty($row['old_pet_name'])
            ? $row['old_pet_name']
            : "Unknown Animal";


        $animal_image = $row['old_pet_image'] ?? "";


        $animal_breed = $row['old_pet_breed'] ?? "";

    }



    /* ==========================================
       IMAGE PATH

       Our animal photos (Bella, Rose, Theo, etc.)
       sit in the root folder, same as they do on
       animals.php / dogs.php / cats.php — so we
       use the filename exactly as stored, with no
       guessed folder prefix. Full URLs (http/https)
       are still used as-is.
    ========================================== */


    if (!empty($animal_image)) {


        if (
            strpos($animal_image, "http://") === 0 ||
            strpos($animal_image, "https://") === 0
        ) {


            $image_path = $animal_image;


        }


        else {


            /*
               Use the stored filename/path exactly
               as it is in the database.
            */

            $image_path = $animal_image;

        }


    } else {


        $image_path = "logo.jpeg";

    }



    /* ==========================================
       STATUS
    ========================================== */


    $status = $row['status'] ?? "Pending";


    if ($status == "Approved") {

        $status_class = "approved";

    }

    elseif (strpos($status, "Rejected") === 0) {

        $status_class = "rejected";

    }

    else {

        $status_class = "pending";

    }


?>


<div class="request-card">


    <!-- IMAGE -->

    <img

        src="<?php echo htmlspecialchars($image_path); ?>"

        class="pet-image"

        alt="<?php echo htmlspecialchars($animal_name); ?>"

        onerror="this.src='logo.jpeg';"

    >



    <!-- INFORMATION -->

    <div class="info">


        <h2>

            <?php echo htmlspecialchars($animal_name); ?>

        </h2>


        <p>

            <strong>Breed:</strong>

            <?php echo htmlspecialchars($animal_breed); ?>

        </p>


        <p>

            <strong>Applicant:</strong>

            <?php echo htmlspecialchars($row['full_name']); ?>

        </p>


        <p>

            <strong>Email:</strong>

            <?php echo htmlspecialchars($row['email']); ?>

        </p>


        <span class="status <?php echo $status_class; ?>">

            <?php echo htmlspecialchars($status); ?>

        </span>


    </div>



    <!-- BUTTONS -->

    <div class="buttons">


        <a

            href="adoption_details.php?id=<?php echo $row['id']; ?>"

            class="view"

        >

            View Details

        </a>



        <?php if ($status == "Pending") { ?>


            <a

                href="update_adoption_status.php?id=<?php echo $row['id']; ?>&status=Approved"

                class="approve"

            >

                Approve

            </a>



            <a

                href="update_adoption_status.php?id=<?php echo $row['id']; ?>&status=Rejected"

                class="reject"

            >

                Reject

            </a>


        <?php } ?>


    </div>


</div>


<?php

}

?>


</div>


</body>

</html>