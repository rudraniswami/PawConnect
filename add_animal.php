<?php

include "db.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/* =====================================================
   CHECK NGO LOGIN
===================================================== */

if (!isset($_SESSION['ngo_id'])) {
    die("NGO is not logged in.");
}

$ngo_id = (int) $_SESSION['ngo_id'];



//    ADD ANIMAL


if (isset($_POST['add_animal'])) {

    
    //    GET FORM DATA
    

    $name = trim($_POST['name'] ?? '');
    $type = trim($_POST['type'] ?? '');
    $breed = trim($_POST['breed'] ?? '');
    $age = trim($_POST['age'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $health_status = trim($_POST['health_status'] ?? '');
    $location = trim($_POST['rescue_location'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $status = trim($_POST['adoption_status'] ?? 'Available');


   
    //    VALIDATION
    

    if ($name === '') {
        die("Animal name is required.");
    }


    $allowed_types = [
        'Dog',
        'Cat'
    ];

    if (!in_array($type, $allowed_types, true)) {
        die("Invalid animal type.");
    }


    $allowed_genders = [
        '',
        'Male',
        'Female'
    ];

    if (!in_array($gender, $allowed_genders, true)) {
        die("Invalid gender.");
    }


    $allowed_health_status = [
        '',
        'Healthy',
        'Under Treatment',
        'Recovering'
    ];

    if (!in_array($health_status, $allowed_health_status, true)) {
        die("Invalid health status.");
    }


    $allowed_status = [
        'Available',
        'Adopted',
        'Pending'
    ];

    if (!in_array($status, $allowed_status, true)) {
        die("Invalid adoption status.");
    }


    
    //    CHECK IMAGE
    

    if (!isset($_FILES['image'])) {
        die("Please select an image.");
    }


    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        die("There was an error uploading the image.");
    }


   
    //    MAXIMUM IMAGE SIZE = 5 MB
    

    $max_size = 5 * 1024 * 1024;

    if ($_FILES['image']['size'] > $max_size) {
        die("Image size must be less than 5 MB.");
    }


    $temp_image = $_FILES['image']['tmp_name'];


    
    //    CHECK REAL IMAGE TYPE
    

    $finfo = finfo_open(FILEINFO_MIME_TYPE);

    if ($finfo === false) {
        die("Unable to verify image type.");
    }


    $file_type = finfo_file(
        $finfo,
        $temp_image
    );

    finfo_close($finfo);


    $allowed_image_types = [

        'image/jpeg' => 'jpg',

        'image/png' => 'png',

        'image/webp' => 'webp'

    ];


    if (!array_key_exists(
        $file_type,
        $allowed_image_types
    )) {

        die(
            "Only JPG, PNG and WEBP images are allowed."
        );
    }


    
    //    VERIFY THAT IT IS ACTUALLY AN IMAGE
    

    if (@getimagesize($temp_image) === false) {

        die(
            "Uploaded file is not a valid image."
        );
    }


   
    //    IMAGE WILL BE STORED IN SAME FOLDER
    //    AS THIS PHP FILE
    

    $extension =
        $allowed_image_types[$file_type];


    
    //    CREATE UNIQUE IMAGE NAME
   

    $image =
        bin2hex(random_bytes(16))
        . "."
        . $extension;


    /*
       No uploads folder.

       The image will be saved directly
       in the current project folder.
    */

    $image_path = __DIR__ . "/" . $image;


    
    //    MOVE UPLOADED IMAGE

    if (!move_uploaded_file(
        $temp_image,
        $image_path
    )) {

        die(
            "Failed to upload image."
        );
    }


    
    //    INSERT ANIMAL INTO DATABASE
    

    $query = "

        INSERT INTO animals

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
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?
        )

    ";


    $stmt = mysqli_prepare(
        $conn,
        $query
    );


    
    //    CHECK QUERY
   

    if (!$stmt) {

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        die(
            "Database error. Please try again."
        );
    }


    
    //    BIND PARAMETERS
    

    mysqli_stmt_bind_param(

        $stmt,

        "issssssssss",

        $ngo_id,
        $name,
        $type,
        $breed,
        $age,
        $gender,
        $location,
        $image,
        $status,
        $health_status,
        $description

    );


    
    //    EXECUTE
    

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);


        /*
           Send NGO to success page.
        */

        header(
            "Location: addanimal_successngo.php"
        );

        exit;

    }


    /* =================================================
       IF DATABASE INSERT FAILS
       DELETE IMAGE
    ================================================= */

    if (file_exists($image_path)) {
        unlink($image_path);
    }


    mysqli_stmt_close($stmt);


    die(
        "Unable to add animal. Please try again."
    );

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Add Animal - PawConnect</title>


<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
>


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



    <form
        method="POST"
        enctype="multipart/form-data"
    >


        <!-- NAME + TYPE -->

        <div class="form-row">


            <div class="form-group">

                <label>
                    Animal Name
                </label>

                <input
                    type="text"
                    name="name"
                    placeholder="Enter animal name"
                    required
                >

            </div>



            <div class="form-group">

                <label>
                    Animal Type
                </label>

                <select
                    name="type"
                    required
                >

                    <option value="">
                        Select Type
                    </option>

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

                <label>
                    Breed
                </label>

                <input
                    type="text"
                    name="breed"
                    placeholder="Enter breed"
                >

            </div>



            <div class="form-group">

                <label>
                    Age
                </label>

                <input
                    type="text"
                    name="age"
                    placeholder="Example: 2 Years"
                >

            </div>


        </div>



        <!-- GENDER + HEALTH -->

        <div class="form-row">


            <div class="form-group">

                <label>
                    Gender
                </label>

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

                <label>
                    Health Status
                </label>

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

            <label>
                Rescue Location
            </label>

            <input
                type="text"
                name="rescue_location"
                placeholder="Enter rescue location"
            >

        </div>



        <!-- DESCRIPTION -->

        <div class="form-group">

            <label>
                Description
            </label>

            <textarea
                name="description"
                placeholder="Enter animal description"
            ></textarea>

        </div>



        <!-- IMAGE -->

        <div class="form-group">

            <label>
                Animal Image
            </label>

            <input
                type="file"
                name="image"
                accept="image/jpeg,image/png,image/webp"
                required
            >

        </div>



        <!-- STATUS -->

        <div class="form-group">

            <label>
                Adoption Status
            </label>

            <select
                name="adoption_status"
                required
            >

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


            <button
                type="submit"
                name="add_animal"
            >

                <i class="fa-solid fa-plus"></i>

                Add Animal

            </button>



            <a
                href="ngo_dashboard.php"
                class="back"
            >

                Back to Dashboard

            </a>


        </div>


    </form>

</div>


</body>

</html>