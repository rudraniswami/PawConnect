<?php

include "db.php";

$query = "SELECT * FROM animals ORDER BY id DESC";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Animals - PawConnect</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Georgia, serif;
    background: #f8f3e8;
    color: #123c2a;
}

.container {
    width: 94%;
    max-width: 1200px;
    margin: 35px auto;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.header h1 {
    font-size: 32px;
}

.header p {
    margin-top: 6px;
    color: #66766d;
}

.add-btn {
    text-decoration: none;
    background: #123c2a;
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
}

.add-btn:hover {
    background: #0b2419;
}

.table-box {
    background: #fffdf7;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #123c2a;
    color: white;
    padding: 14px;
    text-align: left;
}

td {
    padding: 13px;
    border-bottom: 1px solid #e4dfd4;
}

.animal-img {
    width: 65px;
    height: 65px;
    object-fit: cover;
    border-radius: 8px;
}

.status {
    padding: 6px 10px;
    border-radius: 15px;
    font-size: 13px;
    background: #e9ddbf;
}

.actions a {
    text-decoration: none;
    padding: 7px 10px;
    border-radius: 6px;
    color: white;
    font-size: 13px;
    margin-right: 5px;
}

.edit {
    background: #496b7d;
}

.delete {
    background: #8b5365;
}

.empty {
    text-align: center;
    padding: 35px;
    color: #777;
}

</style>

</head>

<body>

<div class="container">

    <div class="header">

        <div>

            <h1>
                <i class="fa-solid fa-paw"></i>
                Animals
            </h1>

            <p>
                Manage rescued animals on PawConnect.
            </p>

        </div>

        <a href="add_animal.php" class="add-btn">

            <i class="fa-solid fa-plus"></i>
            Add Animal

        </a>

    </div>


    <div class="table-box">

        <table>

            <thead>

                <tr>

                    <th>Image</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Breed</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Health</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

            <?php

            if (mysqli_num_rows($result) > 0) {

                while ($animal = mysqli_fetch_assoc($result)) {

            ?>

                <tr>

                    <td>

                        <img
                        src="uploads/animals/<?php echo $animal['image']; ?>"
                        class="animal-img">

                    </td>

                    <td>
                        <?php echo htmlspecialchars($animal['name']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($animal['type']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($animal['breed']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($animal['age']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($animal['gender']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($animal['health_status']); ?>
                    </td>

                    <td>

                        <span class="status">
                            <?php echo htmlspecialchars($animal['adoption_status']); ?>
                        </span>

                    </td>

                    <td class="actions">

                        <a
                        href="edit_animal.php?id=<?php echo $animal['id']; ?>"
                        class="edit">

                            <i class="fa-solid fa-pen"></i>

                        </a>

                        <a
                        href="delete_animal.php?id=<?php echo $animal['id']; ?>"
                        class="delete"
                        onclick="return confirm('Are you sure you want to delete this animal?');">

                            <i class="fa-solid fa-trash"></i>

                        </a>

                    </td>

                </tr>

            <?php

                }

            } else {

            ?>

                <tr>

                    <td colspan="9" class="empty">

                        <i class="fa-solid fa-paw"></i>

                        <br><br>

                        No animals added yet.

                    </td>

                </tr>

            <?php

            }

            ?>

            </tbody>

        </table>

    </div>

</div>

</body>

</html>