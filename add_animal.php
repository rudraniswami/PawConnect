<?php

include "db.php";
session_start();


/* ================================
   CHECK NGO LOGIN
================================ */

if (!isset($_SESSION['ngo_id'])) {
    die("NGO is not logged in.");
}

$ngo_id = $_SESSION['ngo_id'];


/* ================================
   ADD ANIMAL
================================ */

if (isset($_POST['add_animal'])) {

    $name = $_POST['name'];
    $type = $_POST['type'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $health_status = $_POST['health_status'];
    $location = $_POST['rescue_location'];
    $description = $_POST['description'];
    $status = $_POST['adoption_status'];


    /* ================================
       IMAGE UPLOAD
    ================================= */

    $image = $_FILES['image']['name'];
    $temp_image = $_FILES['image']['tmp_name'];

    $image_folder = "uploads/animals/";

    if (!is_dir($image_folder)) {
        mkdir($image_folder, 0777, true);
    }

    move_uploaded_file(
        $temp_image,
        $image_folder . $image
    );


    /* ================================
       INSERT DATA
    ================================= */

    $query = "INSERT INTO animals
    (
        ngo_id,
        name,
        type,
        breed,
        age,
        gender,
        location,
        image,
        status,
        health_status,
        description
    )
    VALUES
    (
        '$ngo_id',
        '$name',
        '$type',
        '$breed',
        '$age',
        '$gender',
        '$location',
        '$image',
        '$status',
        '$health_status',
        '$description'
    )";


    if (mysqli_query($conn, $query)) {

        echo "<script>
                alert('Animal added successfully!');
                window.location='manage_animals.php';
              </script>";

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

<title>Add Animal - PawConnect</title>

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
    width: 90%;
    max-width: 900px;
    margin: 40px auto;
    background: #fffdf7;
    padding: 35px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

h1 {
    color: #123c2a;
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
    background: #fff;
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

@media(max-width: 700px) {

    .form-row {
        flex-direction: column;
        gap: 0;
    }

}

</style>

</head>


<body>


<div class="container">

    <h1>
        <i class="fa-solid fa-paw"></i>
        Add Animal
    </h1>

    <p class="subtitle">
        Add rescued animal information to PawConnect.
    </p>


    <form method="POST"
          enctype="multipart/form-data">


        <!-- NAME + TYPE -->

        <div class="form-row">

            <div class="form-group">

                <label>Animal Name</label>

                <input type="text"
                       name="name"
                       placeholder="Enter animal name"
                       required>

            </div>


            <div class="form-group">

                <label>Animal Type</label>

                <select name="type" required>

                    <option value="">Select Type</option>

                    <option value="Dog">
                        Dog
                    </option>

                    <option value="Cat">
                        Cat
                    </option>

                </select>

            </div>

        </div>


        <!-- BREED + AGE -->

        <div class="form-row">

            <div class="form-group">

                <label>Breed</label>

                <input type="text"
                       name="breed"
                       placeholder="Enter breed">

            </div>


            <div class="form-group">

                <label>Age</label>

                <input type="text"
                       name="age"
                       placeholder="Example: 2 Years">

            </div>

        </div>


        <!-- GENDER + HEALTH -->

        <div class="form-row">

            <div class="form-group">

                <label>Gender</label>

                <select name="gender">

                    <option value="">
                        Select Gender
                    </option>

                    <option value="Male">
                        Male
                    </option>

                    <option value="Female">
                        Female
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>Health Status</label>

                <select name="health_status">

                    <option value="">
                        Select Health Status
                    </option>

                    <option value="Healthy">
                        Healthy
                    </option>

                    <option value="Under Treatment">
                        Under Treatment
                    </option>

                    <option value="Recovering">
                        Recovering
                    </option>

                </select>

            </div>

        </div>


        <!-- LOCATION -->

        <div class="form-group">

            <label>Rescue Location</label>

            <input type="text"
                   name="rescue_location"
                   placeholder="Enter rescue location">

        </div>


        <!-- DESCRIPTION -->

        <div class="form-group">

            <label>Description</label>

            <textarea name="description"
                      placeholder="Enter animal description"></textarea>

        </div>


        <!-- IMAGE -->

        <div class="form-group">

            <label>Animal Image</label>

            <input type="file"
                   name="image"
                   accept="image/*"
                   required>

        </div>


        <!-- STATUS -->

        <div class="form-group">

            <label>Adoption Status</label>

            <select name="adoption_status">

                <option value="Available">
                    Available
                </option>

                <option value="Adopted">
                    Adopted
                </option>

                <option value="Pending">
                    Pending
                </option>

            </select>

        </div>


        <!-- BUTTONS -->

        <div class="buttons">

            <button type="submit"
                    name="add_animal">

                <i class="fa-solid fa-plus"></i>

                Add Animal

            </button>


            <a href="admin_dashboard.php"
               class="back">

                Back to Dashboard

            </a>

        </div>

    </form>

</div>


</body>

</html>