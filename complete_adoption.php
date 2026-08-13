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