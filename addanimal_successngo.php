<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<title>Animal Added Successfully | PawConnect</title>

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
    color:#333;
    display:flex;
    flex-direction:column;
}


/* =========================
   SUCCESS SECTION
========================= */

.success-wrapper{
    flex:1;

    display:flex;
    justify-content:center;
    align-items:center;

    padding:70px 20px;

    background:
        radial-gradient(
            circle at top left,
            rgba(198,161,91,.10),
            transparent 35%
        ),
        #FFFDF7;
}

.success-card{
    width:100%;
    max-width:650px;

    background:#ffffff;

    padding:55px 45px;

    text-align:center;

    border-radius:30px;

    border:1px solid #E7DCC4;

    box-shadow:0 20px 45px rgba(18,60,42,.12);

    animation:cardIn .6s ease;
}

@keyframes cardIn{

    from{
        opacity:0;
        transform:translateY(25px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }

}


/* SUCCESS ICON */

.success-icon{
    width:100px;
    height:100px;

    margin:0 auto 25px;

    display:flex;
    justify-content:center;
    align-items:center;

    border-radius:50%;

    background:#E8F3ED;

    border:3px solid #C6A15B;

    color:#123C2A;

    font-size:45px;

    box-shadow:
        0 10px 25px rgba(198,161,91,.20);
}


/* TEXT */

.success-card h1{
    color:#123C2A;
    font-size:42px;
    margin-bottom:15px;
}

.success-card h1 span{
    color:#C6A15B;
}

.success-card p{
    color:#666;
    font-size:18px;
    line-height:1.7;
    margin-bottom:35px;
}


/* BUTTONS */

.success-buttons{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:15px;
    flex-wrap:wrap;
}

.dashboard-btn,
.animals-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:9px;

    padding:14px 28px;

    border-radius:50px;

    text-decoration:none;

    font-size:16px;
    font-weight:bold;

    transition:.3s ease;
}


/* DASHBOARD */

.dashboard-btn{
    background:#123C2A;
    color:#FFFDF7;
    border:2px solid #123C2A;

    box-shadow:0 10px 25px rgba(18,60,42,.20);
}

.dashboard-btn:hover{
    background:#1d6747;
    transform:translateY(-4px);
}


/* ADD ANOTHER */

.animals-btn{
    background:#C6A15B;
    color:#123C2A;
    border:2px solid #C6A15B;

    box-shadow:0 10px 25px rgba(198,161,91,.20);
}

.animals-btn:hover{
    background:#FFFDF7;
    transform:translateY(-4px);
}


/* =========================
   MOBILE
========================= */

@media(max-width:600px){

    .nav{
        min-height:65px;
        padding:8px 15px;
        justify-content:center;
    }

    .logo img{
        width:50px;
        height:50px;
    }

    .logo h2{
        font-size:23px;
    }

    .success-wrapper{
        padding:45px 18px;
    }

    .success-card{
        padding:40px 22px;
        border-radius:25px;
    }

    .success-icon{
        width:85px;
        height:85px;
        font-size:38px;
    }

    .success-card h1{
        font-size:32px;
    }

    .success-card p{
        font-size:16px;
    }

    .success-buttons{
        flex-direction:column;
        width:100%;
    }

    .dashboard-btn,
    .animals-btn{
        width:100%;
    }

}

</style>
</head>

<body>



<!-- =========================
     SUCCESS MESSAGE
========================= -->

<section class="success-wrapper">

    <div class="success-card">

        <div class="success-icon">

            <i class="fa-solid fa-paw"></i>

        </div>


        <h1>
            Animal Added <span>Successfully!</span>
        </h1>


        <p>
            The animal has been successfully added to PawConnect.
            It is now available in the animal listings for adoption.
        </p>


        <div class="success-buttons">

            <!-- GO TO DASHBOARD -->

            <a href="ngo_dashboard.php" class="dashboard-btn">

                <i class="fa-solid fa-gauge-high"></i>

                Go to Dashboard

            </a>


            <!-- ADD ANOTHER ANIMAL -->

            <a href="addanimal.php" class="animals-btn">

                <i class="fa-solid fa-plus"></i>

                Add Another Animal

            </a>

        </div>

    </div>

</section>



</body>
</html>