<?php

include "db.php";

if (!isset($_GET['id'])) {
    die("Invalid Animal ID");
}

$id = intval($_GET['id']);


/* FETCH ANIMAL */

$query = "SELECT * FROM animals WHERE id = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    die("Animal not found");
}

$animal = mysqli_fetch_assoc($result);


/* UPDATE ANIMAL */

if (isset($_POST['update_animal'])) {

    $name = $_POST['name'];
    $type = $_POST['type'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $health_status = $_POST['health_status'];
    $rescue_location = $_POST['rescue_location'];
    $description = $_POST['description'];
    $adoption_status = $_POST['adoption_status'];

    $image = $animal['image'];


    /* NEW IMAGE */

    if (!empty($_FILES['image']['name'])) {

        $new_image = $_FILES['image']['name'];
        $temp_image = $_FILES['image']['tmp_name'];

        $image_folder = "uploads/animals/";

        move_uploaded_file(
            $temp_image,
            $image_folder . $new_image
        );

        $image = $new_image;
    }


    /* UPDATE QUERY */

    $update = "UPDATE animals SET

        name='$name',
        type='$type',
        breed='$breed',
        age='$age',
        gender='$gender',
        health_status='$health_status',
        rescue_location='$rescue_location',
        description='$description',
        image='$image',
        adoption_status='$adoption_status'

        WHERE id=$id";


    if (mysqli_query($conn, $update)) {

        echo "<script>

            alert('Animal updated successfully!');

            window.location='manage_animals.php';

        </script>";

        exit();

    } else {

        echo "Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Edit Animal - PawConnect</title>

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

    width: 90%;

    max-width: 900px;

    margin: 40px auto;

    background: #fffdf7;

    padding: 35px;

    border-radius: 15px;

    box-shadow:
    0 5px 20px rgba(0,0,0,0.08);
}

h1 {

    margin-bottom: 8px;
}

.subtitle {

    color: #66766d;

    margin-bottom: 30px;
}

.form-row {

    display: flex;

    gap: 20px;
}

.form-group {

    flex: 1;

    margin-bottom: 20px;
}

label {

    display: block;

    margin-bottom: 8px;

    font-weight: bold;
}

input,
select,
textarea {

    width: 100%;

    padding: 12px;

    border: 1px solid #d8d0c0;

    border-radius: 8px;

    font-size: 15px;
}

textarea {

    height: 110px;

    resize: none;
}

input:focus,
select:focus,
textarea:focus {

    outline: none;

    border-color: #c6a15b;
}

.current-image {

    width: 100px;

    height: 100px;

    object-fit: cover;

    border-radius: 10px;

    margin-bottom: 10px;
}

.buttons {

    margin-top: 15px;

    display: flex;

    gap: 12px;
}

button {

    border: none;

    padding: 13px 25px;

    border-radius: 8px;

    background: #123c2a;

    color: white;

    font-size: 15px;

    cursor: pointer;
}

button:hover {

    background: #0b2419;
}

.back {

    text-decoration: none;

    padding: 13px 25px;

    border-radius: 8px;

    background: #e9ddbf;

    color: #123c2a;
}

</style>

</head>

<body>


<div class="container">

    <h1>🐾 Edit Animal</h1>

    <p class="subtitle">

        Update rescued animal information.

    </p>


    <form method="POST"
          enctype="multipart/form-data">


        <div class="form-row">

            <div class="form-group">

                <label>Animal Name</label>

                <input
                type="text"
                name="name"
                value="<?php echo htmlspecialchars($animal['name']); ?>"
                required>

            </div>


            <div class="form-group">

                <label>Animal Type</label>

                <select name="type">

                    <option value="Dog"
                    <?php if($animal['type']=="Dog") echo "selected"; ?>>
                    Dog
                    </option>

                    <option value="Cat"
                    <?php if($animal['type']=="Cat") echo "selected"; ?>>
                    Cat
                    </option>

                </select>

            </div>

        </div>


        <div class="form-row">

            <div class="form-group">

                <label>Breed</label>

                <input
                type="text"
                name="breed"
                value="<?php echo htmlspecialchars($animal['breed']); ?>">

            </div>


            <div class="form-group">

                <label>Age</label>

                <input
                type="text"
                name="age"
                value="<?php echo htmlspecialchars($animal['age']); ?>">

            </div>

        </div>


        <div class="form-row">

            <div class="form-group">

                <label>Gender</label>

                <select name="gender">

                    <option value="Male"
                    <?php if($animal['gender']=="Male") echo "selected"; ?>>
                    Male
                    </option>

                    <option value="Female"
                    <?php if($animal['gender']=="Female") echo "selected"; ?>>
                    Female
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>Health Status</label>

                <select name="health_status">

                    <option value="Healthy"
                    <?php if($animal['health_status']=="Healthy") echo "selected"; ?>>
                    Healthy
                    </option>

                    <option value="Under Treatment"
                    <?php if($animal['health_status']=="Under Treatment") echo "selected"; ?>>
                    Under Treatment
                    </option>

                    <option value="Recovering"
                    <?php if($animal['health_status']=="Recovering") echo "selected"; ?>>
                    Recovering
                    </option>

                </select>

            </div>

        </div>


        <div class="form-group">

            <label>Rescue Location</label>

            <input
            type="text"
            name="rescue_location"
            value="<?php echo htmlspecialchars($animal['rescue_location']); ?>">

        </div>


        <div class="form-group">

            <label>Description</label>

            <textarea
            name="description"><?php echo htmlspecialchars($animal['description']); ?></textarea>

        </div>


        <div class="form-group">

            <label>Current Image</label>

            <?php if (!empty($animal['image'])) { ?>

                <br>

                <img
                src="uploads/animals/<?php echo htmlspecialchars($animal['image']); ?>"
                class="current-image">

            <?php } ?>

        </div>


        <div class="form-group">

            <label>Change Image</label>

            <input
            type="file"
            name="image"
            accept="image/*">

        </div>


        <div class="form-group">

            <label>Adoption Status</label>

            <select name="adoption_status">

                <option value="Available"
                <?php if($animal['adoption_status']=="Available") echo "selected"; ?>>
                Available
                </option>

                <option value="Pending"
                <?php if($animal['adoption_status']=="Pending") echo "selected"; ?>>
                Pending
                </option>

                <option value="Adopted"
                <?php if($animal['adoption_status']=="Adopted") echo "selected"; ?>>
                Adopted
                </option>

            </select>

        </div>


        <div class="buttons">

            <button
            type="submit"
            name="update_animal">

                Update Animal

            </button>


            <a
            href="admin_animal.php"
            class="back">

                Cancel

            </a>

        </div>

    </form>

</div>

</body>

</html>