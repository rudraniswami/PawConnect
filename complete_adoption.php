<?php
include "db.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$completed_adoption = null;

if ($id > 0) {

    $update = "UPDATE adoption_requests 
               SET status = 'Completed'
               WHERE id = $id";

    mysqli_query($conn, $update);

    $query = "SELECT * FROM adoption_requests
              WHERE id = $id
              AND status = 'Completed'";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $completed_adoption = mysqli_fetch_assoc($result);
    }
}
?>

<div style="
    background:#ffffff;
    border:3px solid #173c2d;
    border-radius:20px;
    padding:30px;
    margin:30px 0;
    color:#173c2d;
">

    <h2>🐾 ADOPTION COMPLETED 🎉</h2>

    <?php if ($completed_adoption) { ?>

        <p>
            Congratulations!
        </p>

        <p>
            Your adoption has been completed successfully.
        </p>

        <p>
            Status:
            <strong>
                <?php echo htmlspecialchars($completed_adoption['status']); ?>
            </strong>
        </p>

        <p>
            Request ID:
            <?php echo $completed_adoption['id']; ?>
        </p>

    <?php } else { ?>

        <p>
            No completed adoption found.
        </p>

        <p>
            The database status is probably still
            <strong>Approved</strong>.
        </p>

    <?php } ?>

</div>