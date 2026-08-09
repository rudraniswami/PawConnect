<?php

include "db.php";

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];


    if ($password !== $confirm_password) {

        $message = "Passwords do not match.";
        $message_type = "error";

    } else {

        // Check whether email already exists

        $check = mysqli_prepare(
            $conn,
            "SELECT id FROM users WHERE email = ?"
        );

        mysqli_stmt_bind_param(
            $check,
            "s",
            $email
        );

        mysqli_stmt_execute($check);

        mysqli_stmt_store_result($check);


        if (mysqli_stmt_num_rows($check) > 0) {

            $message = "An account with this email already exists.";
            $message_type = "error";

        } else {

            // Secure password

            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );


            // Insert user

            $insert = mysqli_prepare(
                $conn,
                "INSERT INTO users (name, email, password)
                 VALUES (?, ?, ?)"
            );

            mysqli_stmt_bind_param(
                $insert,
                "sss",
                $name,
                $email,
                $hashed_password
            );


            if (mysqli_stmt_execute($insert)) {

                $message = "Account created successfully!";
                $message_type = "success";

            } else {

                $message = "Something went wrong. Please try again.";
                $message_type = "error";

            }

            mysqli_stmt_close($insert);
        }

        mysqli_stmt_close($check);
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Create Account - PawConnect</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{

            font-family:'Times New Roman', Times, serif;

            background:#f7f3eb;

            min-height:100vh;

            display:flex;

            justify-content:center;

            align-items:center;

            padding:30px 20px;
        }

        .register-container{

            width:100%;

            max-width:550px;

            background:white;

            padding:50px;

            border-radius:25px;

            box-shadow:0 15px 40px rgba(0,0,0,.12);
        }

        h1{

            color:#0F5A39;

            font-family:Georgia,serif;

            font-size:42px;

            margin-bottom:10px;

            text-align:center;
        }

        .subtitle{

            text-align:center;

            color:#666;

            font-size:18px;

            line-height:1.6;

            margin-bottom:30px;
        }

        .heading-line{

            width:70px;

            height:4px;

            background:#C89B3C;

            border-radius:5px;

            margin:0 auto 30px;
        }

        label{

            display:block;

            font-size:18px;

            font-weight:600;

            color:#222;

            margin-bottom:9px;
        }

        .input-box{

            width:100%;

            height:60px;

            border:2px solid #e2e2e2;

            border-radius:14px;

            display:flex;

            align-items:center;

            padding:0 18px;

            margin-bottom:22px;
        }

        .input-box:focus-within{

            border-color:#0F5A39;
        }

        .input-box i{

            color:#777;

            font-size:20px;
        }

        .input-box input{

            width:100%;

            border:none;

            outline:none;

            margin-left:13px;

            font-family:'Times New Roman', Times, serif;

            font-size:17px;
        }

        .register-button{

            width:100%;

            height:60px;

            border:none;

            border-radius:14px;

            background:#0F5A39;

            color:white;

            font-family:'Times New Roman', Times, serif;

            font-size:21px;

            cursor:pointer;

            margin-top:5px;

            transition:.3s;
        }

        .register-button:hover{

            background:#0b472d;

            transform:translateY(-2px);
        }

        .register-button i{

            margin-right:8px;
        }

        .message{

            padding:13px 15px;

            border-radius:10px;

            margin-bottom:22px;

            text-align:center;

            font-size:16px;
        }

        .success{

            background:#e8f5e9;

            color:#176b3a;
        }

        .error{

            background:#fdecec;

            color:#a52828;
        }

        .login-link{

            display:block;

            text-align:center;

            margin-top:25px;

            color:#0F5A39;

            text-decoration:none;

            font-size:17px;

            font-weight:600;
        }

        .login-link:hover{

            text-decoration:underline;
        }

        @media(max-width:600px){

            .register-container{

                padding:35px 22px;

                border-radius:18px;
            }

            h1{

                font-size:32px;
            }

            .subtitle{

                font-size:16px;
            }

            .input-box{

                height:56px;
            }

            .register-button{

                height:56px;

                font-size:19px;
            }
        }

    </style>

</head>

<body>


<div class="register-container">


    <h1>Create Account</h1>

    <div class="heading-line"></div>


    <p class="subtitle">

        Join PawConnect and help rescued animals
        find their forever homes. 🐾

    </p>


    <?php if ($message != ""): ?>

        <div class="message <?php echo $message_type; ?>">

            <?php echo htmlspecialchars($message); ?>

        </div>

    <?php endif; ?>


    <form method="POST" action="">


        <label for="name">
            Full Name
        </label>

        <div class="input-box">

            <i class="fa-regular fa-user"></i>

            <input
                type="text"
                id="name"
                name="name"
                placeholder="Enter your name"
                required
            >

        </div>


        <label for="email">
            Email Address
        </label>

        <div class="input-box">

            <i class="fa-regular fa-envelope"></i>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
                required
            >

        </div>


        <label for="password">
            Password
        </label>

        <div class="input-box">

            <i class="fa-solid fa-lock"></i>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Create a password"
                required
            >

        </div>


        <label for="confirm_password">
            Confirm Password
        </label>

        <div class="input-box">

            <i class="fa-solid fa-lock"></i>

            <input
                type="password"
                id="confirm_password"
                name="confirm_password"
                placeholder="Confirm your password"
                required
            >

        </div>


        <button
            type="submit"
            class="register-button"
        >

            <i class="fa-solid fa-paw"></i>

            Create Account

        </button>


    </form>


    <a
        href="login.php"
        class="login-link"
    >

        Already have an account? Login

    </a>


</div>


</body>

</html>