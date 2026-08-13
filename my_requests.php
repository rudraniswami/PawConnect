<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("location: login.php");
    exit();
}

include "db.php";

$user_id = intval($_SESSION['user_id']);


/* ==========================================
   GET THIS USER'S ADOPTION REQUESTS ONLY
   (user_id filter keeps every user's list
   separate - no cross-user data possible)
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

WHERE ar.user_id = ?

ORDER BY ar.created_at DESC
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();

?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>My Adoption Requests | PawConnect</title>


<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Times New Roman', Times, serif;
}

html,
body{
    min-height:100%;
}

body{
    background:#FFFDF7;
    color:#123C2A;
}


/* =========================
   MAIN CONTAINER
========================= */

.container{
    width:92%;
    max-width:1100px;
    margin:0 auto;
    padding:45px 0 80px;
}


/* =========================
   TOP LINKS
========================= */

.top-links{
    display:flex;
    align-items:center;
    gap:12px;

    margin-bottom:45px;
}

.top-links a{
    display:inline-flex;
    align-items:center;

    text-decoration:none;

    color:#123C2A;
    background:#F5EFE3;

    padding:10px 18px;

    border-radius:25px;

    font-size:15px;
    font-weight:bold;

    transition:.3s ease;
}

.top-links a:hover{
    background:#123C2A;
    color:#FFFDF7;

    transform:translateY(-2px);
}


/* =========================
   PAGE HEADING
========================= */

h1{
    color:#123C2A;

    font-size:clamp(38px,5vw,55px);

    line-height:1.1;

    margin-bottom:12px;
}

.subtitle{
    color:#777;

    font-size:18px;

    line-height:1.6;

    margin-bottom:40px;
}


/* =========================
   REQUEST CARD
========================= */

.request-card{
    position:relative;

    background:#fff;

    border:1px solid #eee8dc;

    border-radius:30px;

    padding:22px;

    margin-bottom:22px;

    display:flex;

    gap:25px;

    align-items:center;

    box-shadow:0 12px 30px rgba(18,60,42,.08);

    transition:.35s ease;

    overflow:hidden;
}

.request-card::before{
    content:"";

    position:absolute;

    left:0;
    top:0;
    bottom:0;

    width:5px;

    background:#C6A15B;
}

.request-card:hover{
    transform:translateY(-5px);

    box-shadow:0 18px 38px rgba(18,60,42,.13);
}


/* =========================
   PET IMAGE
========================= */

.pet-image{
    width:150px;
    height:150px;

    flex-shrink:0;

    object-fit:cover;

    border-radius:22px;

    background:#F5EFE3;

    box-shadow:0 8px 20px rgba(0,0,0,.10);
}


/* =========================
   INFO
========================= */

.info{
    flex:1;

    min-width:0;
}

.info h2{
    color:#123C2A;

    font-size:30px;

    margin-bottom:12px;
}

.info p{
    margin:7px 0;

    color:#666;

    font-size:16px;
}

.info strong{
    color:#123C2A;
}


/* =========================
   STATUS
========================= */

.status{
    display:inline-flex;

    align-items:center;

    padding:8px 17px;

    border-radius:30px;

    margin-top:12px;

    font-size:14px;

    font-weight:bold;

    letter-spacing:.3px;
}

.pending{
    background:#FFF3CD;

    color:#856404;

    border:1px solid #F0D98A;
}

.approved{
    background:#DFF2E4;

    color:#176B36;

    border:1px solid #A9D9B6;
}

.rejected{
    background:#FBE2E4;

    color:#9B2835;

    border:1px solid #E8B5BA;
}


/* =========================
   NO DATA
========================= */

.no-data{
    background:white;

    border:1px solid #eee8dc;

    padding:55px 30px;

    border-radius:30px;

    text-align:center;

    color:#777;

    font-size:18px;

    box-shadow:0 12px 30px rgba(18,60,42,.07);
}

.no-data::before{
    content:"🐾";

    display:block;

    font-size:45px;

    margin-bottom:15px;

    opacity:.6;
}


/* =========================
   RESPONSIVE
========================= */

@media(max-width:700px){

    .container{
        width:90%;

        padding:30px 0 60px;
    }

    .top-links{
        flex-wrap:wrap;

        margin-bottom:35px;
    }

    h1{
        font-size:38px;
    }

    .subtitle{
        font-size:16px;

        margin-bottom:30px;
    }

    .request-card{
        flex-direction:column;

        align-items:flex-start;

        padding:20px;

        border-radius:25px;
    }

    .pet-image{
        width:100%;

        height:240px;

        border-radius:20px;
    }

    .info{
        width:100%;
    }

    .info h2{
        font-size:27px;
    }

    .status{
        margin-top:10px;
    }
}


@media(max-width:450px){

    .top-links{
        gap:8px;
    }

    .top-links a{
        font-size:14px;

        padding:9px 14px;
    }

    h1{
        font-size:34px;
    }

    .request-card{
        padding:16px;
    }

    .pet-image{
        height:210px;
    }

    .info h2{
        font-size:25px;
    }

    .info p{
        font-size:15px;
    }
}

</style>

</head>


<body>


<div class="container">


    <div class="top-links">

        <a href="user_dashboard.php">← Back to Dashboard</a>

        <a href="home.php">Home</a>

    </div>


    <h1>
        My Adoption Requests
    </h1>


    <p class="subtitle">
        Track the status of the adoption requests you've submitted.
    </p>


<?php

if ($result->num_rows == 0) {

    echo '

    <div class="no-data">

        You have not submitted any adoption requests yet.

    </div>

    ';

}


while ($row = $result->fetch_assoc()) {

    /* ==========================================
       FIND CORRECT ANIMAL
    ========================================== */

    if (
        isset($row['animal_id']) &&
        $row['animal_id'] > 0 &&
        !empty($row['animal_name'])
    ) {

        $animal_name = $row['animal_name'];
        $animal_image = $row['animal_image'];
        $animal_breed = $row['animal_breed'];

    } else {

        $animal_name = !empty($row['old_pet_name'])
            ? $row['old_pet_name']
            : "Unknown Animal";

        $animal_image = $row['old_pet_image'] ?? "";

        $animal_breed = $row['old_pet_breed'] ?? "";

    }


    /* ==========================================
       IMAGE PATH
       (uses the stored filename as-is, same
       rule as admin_adoptions.php)
    ========================================== */

    if (!empty($animal_image)) {

        $image_path = $animal_image;

    } else {

        $image_path = "logo.jpeg";

    }


    /* ==========================================
       STATUS
    ========================================== */

    $status = $row['status'] ?? "Pending";

    if ($status == "Approved") {
        $status_class = "approved";
        $status_label = "Approved";
    }
    elseif ($status == "Rejected - Animal Adopted") {
        $status_class = "rejected";
        $status_label = "Animal Already Adopted";
    }
    elseif (strpos($status, "Rejected") === 0) {
        $status_class = "rejected";
        $status_label = "Rejected";
    }
    else {
        $status_class = "pending";
        $status_label = "Pending";
    }

?>


<div class="request-card">


    <img

        src="<?php echo htmlspecialchars($image_path); ?>"

        class="pet-image"

        alt="<?php echo htmlspecialchars($animal_name); ?>"

        onerror="this.src='logo.jpeg';"

    >


    <div class="info">

        <h2>
            <?php echo htmlspecialchars($animal_name); ?>
        </h2>

        <p>
            <strong>Breed:</strong>
            <?php echo htmlspecialchars($animal_breed); ?>
        </p>

        <p>
            <strong>Submitted:</strong>
            <?php echo htmlspecialchars($row['created_at']); ?>
        </p>

        <span class="status <?php echo $status_class; ?>">
            <?php echo htmlspecialchars($status_label); ?>
        </span>

    </div>


</div>


<?php

}

?>


</div>


</body>

</html>