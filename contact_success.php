<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Message Sent | PawConnect</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Times New Roman', Times, serif;
}

body{
    min-height:100vh;
    background:#FFFDF7;

    display:flex;
    justify-content:center;
    align-items:center;

    padding:30px;
}

.success-box{
    width:100%;
    max-width:600px;

    background:white;

    text-align:center;

    padding:55px 40px;

    border-radius:30px;

    box-shadow:0 20px 50px rgba(18,60,42,.12);

    border:1px solid #eee8dc;
}

.icon{
    width:80px;
    height:80px;

    margin:0 auto 25px;

    background:#DFF2E4;

    color:#123C2A;

    border-radius:50%;

    display:flex;
    justify-content:center;
    align-items:center;

    font-size:40px;
}

.success-box h1{
    color:#123C2A;

    font-size:42px;

    margin-bottom:15px;
}

.success-box p{
    color:#666;

    font-size:18px;

    line-height:1.7;

    margin-bottom:25px;
}

.wait{
    background:#F5EFE3;

    padding:20px;

    border-radius:18px;

    color:#555;

    line-height:1.6;

    margin-bottom:30px;
}

.home-btn{
    display:inline-block;

    text-decoration:none;

    background:#123C2A;

    color:#FFFDF7;

    padding:14px 30px;

    border-radius:30px;

    font-weight:bold;
}

.home-btn:hover{
    background:#1D6747;
}

</style>

</head>

<body>

<div class="success-box">

    <div class="icon">
        ✓
    </div>

    <h1>Message Sent!</h1>

    <p>
        Thank you for contacting PawConnect.
        Your message has been successfully submitted.
    </p>

    <div class="wait">

        <strong>Please wait for a reply.</strong>

        <br>

        Our team will review your message
        and get back to you soon.

    </div>

    <a href="home.php" class="home-btn">
        Back to Home
    </a>

</div>

</body>

</html>