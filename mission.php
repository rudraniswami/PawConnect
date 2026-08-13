<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Mission</title>
    <style>

            *{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Times New Roman', Times, serif;
}

/* ================= NAVBAR ================= */

.nav{
    width:100%;
    min-height:80px;
    position:sticky;
    top:0;
    z-index:999;
    background:#123C2A;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 40px;
    box-shadow:0 4px 15px rgba(0,0,0,0.12);
    gap:20px;
}


.logo{
    display:flex;
    align-items:center;
    gap:12px;
    flex-shrink:0;
}

.logo img{
    width:65px;
    height:65px;
    border-radius:50%;
    object-fit:cover;
}

.logo h2{
    color:#FFFDF7;
    font-size:28px;
    letter-spacing:1px;
}

.menu{
    display:flex;
    align-items:center;
    gap:26px;
    flex-wrap:wrap;
    justify-content:center;
}

.menu a{
    text-decoration:none;
    color:#FFFDF7;
    font-size:16px;
    font-weight:bold;
    transition:0.3s ease;
}

.menu > a:hover{
    color:#C6A15B;
}

.login-btn{
    text-decoration:none;
    color:#FFFDF7;
    background:#C6A15B;
    padding:10px 22px;
    border-radius:30px;
    font-weight:bold;
    transition:0.3s ease;
    flex-shrink:0;
}

.login-btn:hover{
    background:#a88344;
    transform:translateY(-2px);
}

/* EXPLORE DROPDOWN */
.dropdown{
    position:relative;
}

.dropdown > a{
    display:flex;
    align-items:center;
    gap:6px;
    padding:10px 14px;
    border-radius:25px;
    transition:0.3s ease;
}

.dropdown > a:hover{
    background:rgba(255,255,255,0.08);
}

.dropdown-content{
    position:absolute;
    top:52px;
    left:50%;
    transform:translateX(-50%) translateY(10px);
    width:620px;
    padding:22px;
    background:#FFFDF7;
    border-radius:16px;
    box-shadow:0 12px 28px rgba(0,0,0,.18);
    display:flex;
    justify-content:space-between;
    gap:20px;
    opacity:0;
    visibility:hidden;
    transition:0.3s ease;
}

.dropdown:hover .dropdown-content{
    opacity:1;
    visibility:visible;
    transform:translateX(-50%) translateY(0);
}

.column{
    width:30%;
    display:flex;
    flex-direction:column;
}

.column h3{
    color:#123C2A;
    font-size:18px;
    margin-bottom:12px;
    padding-bottom:8px;
    border-bottom:2px solid #C6A15B;
}

.column a{
    text-decoration:none;
    color:#444;
    margin:7px 0;
    font-size:15px;
    font-weight:normal;
    transition:0.3s;
}

.column a:hover{
    color:#C6A15B;
    padding-left:4px;
}



/* HERO */

 .hero-section{
    width:100%;
    background:#f8f3e8;
    padding:80px 0;
}

.hero{
    width:90%;
    margin: auto;
display:flex;
justify-content:space-between;
align-items:center;
gap:60px;

}

.hero-text{
flex:1;
}

.hero-text h1{
font-size:74px;
font-family:'Playfair Display',serif;
color:#143F2D;
}

.hero-text h3{
margin:18px 0;
font-size:33px;
color:#C8933B;
font-family:'Playfair Display',serif;
}

.hero-text p{
font-size:19px;
line-height:34px;
margin-top:20px;
color:#444;
}

.mission-box{
display:flex;
gap:30px;
margin-top:50px;
}

.box{
display:flex;
align-items:center;
gap:15px;
}


.hero-icon{
width:70px;
height:70px;
background:#123C2A;
border-radius:50%;
display:flex;
justify-content:center;
align-items:center;
box-shadow:0 8px 20px rgba(0,0,0,.1);
}

.hero-icon i{
font-size:28px;
color:white;
}

.box h4{
font-size:22px;
color:#143F2D;
}

.box p{
font-size:15px;
margin-top:5px;
line-height:24px;
}

.hero-image{
flex:1;
display:flex;
justify-content:center;
align-items:center;
}


.hero-image img{
width:95%;
max-width: 500px;
height:auto;
display: block;

}


/*================ Mission Pillars ================*/
.mission-section{
   width: 100%;
   background: #f8f3e8;
   padding:80px 0;

}

.mission-pillars{
    width:90%;
    margin: auto;
}

.title{
    text-align:center;
    margin-bottom:45px;
}

.title h2{
    font-size:40px;
    color:#123C2A;
    margin-bottom:12px;
}

.line{
    width:90px;
    height:4px;
    background:#C6A15B;
    margin:auto;
    border-radius:20px;
}

.pillar-container{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:25px;
}

.pillar-card{
    background:#fff;
    border-radius:20px;
    padding:35px 25px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    transition:.4s;
    cursor:pointer;
}

.pillar-card:hover{
    transform:translateY(-10px);
    box-shadow:0 18px 35px rgba(18,60,42,.2);
}

.pillar-icon{
    width:90px;
    height:90px;
    background:#123C2A;
    color:#fff;
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    margin:auto;
    font-size:34px;
    transition:.5s;
}

.pillar-card:hover .pillar-icon{
    background:#C6A15B;
    transform:scale(1.1);
}

.pillar-card h3{
    margin:22px 0 15px;
    color:#123C2A;
    font-size:28px;
}

.pillar-card p{
    color:#555;
    line-height:1.8;
    font-size:15px;
}

/*================ Mission Impact ================*/

.mission-impact-section{
    width:100%;
    background:#F8F3E8;
    padding:60px 0 120px;
}

.mission-impact{
    width:90%;
    margin:auto;
}

/* Heading */
.title{
    text-align:center;
    margin-bottom:50px;
}

.title h2{
    font-size:42px;
    color:#123C2A;
    font-weight:bold;
    margin-bottom:15px;
}

.line{
    width:100px;
    height:5px;
    background:#C6A15B;
    margin:auto;
    border-radius:10px;
}

/* Cards */
.impact-container{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
    gap:30px;
    margin-top:50px;
}

.impact-card{
    background:#fff;
    border-radius:20px;
    padding:40px 25px;
    text-align:center;
    box-shadow:0 8px 20px rgba(0,0,0,0.1);
    transition:0.4s;
}

.impact-card:hover{
    transform:translateY(-10px);
    box-shadow:0 15px 30px rgba(0,0,0,0.18);
}

.impact-icon{
    width:80px;
    height:80px;
    margin:auto;
    border-radius:50%;
    background:#123C2A;
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:30px;
    transition:0.4s;
}

.impact-card:hover .impact-icon{
    background:#C6A15B;
    transform:scale(1.1);
}

.impact-card h3{
    font-size:40px;
    color:#123C2A;
    margin:20px 0 10px;
}

.impact-card p{
    color:#555;
    font-size:17px;
    line-height:1.6;
}

/* =====================================================
   FOOTER
===================================================== */

.footer{
    background:#123C2A;
    color:white;
    padding:45px 70px 15px;
}


/* FOOTER TOP */

.footer-top{
    display:grid;
    grid-template-columns:2fr 1fr 1fr 1.3fr;
    gap:40px;
    padding-bottom:25px;
    border-bottom:1px solid rgba(255,255,255,.15);
}


/* LOGO */

.footer-logo{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:15px;
}


.footer-logo img{
    width:55px;
    height:55px;
    border-radius:50%;
    object-fit:cover;
}


.footer-logo h2{
    color:#C6A15B;
    font-size:30px;
}


/* ABOUT */

.footer-about p{
    color:#E8E8E8;
    line-height:1.6;
    margin-bottom:16px;
    max-width:350px;
}


/* SOCIAL ICONS */

.social-icons{
    display:flex;
    gap:10px;
}


.social-icons a{
    width:40px;
    height:40px;

    display:flex;
    justify-content:center;
    align-items:center;

    border-radius:50%;

    background:rgba(255,255,255,.08);

    color:white;

    text-decoration:none;

    transition:.3s;
}


.social-icons a:hover{
    background:#C6A15B;
    color:#123C2A;
    transform:translateY(-3px);
}


/* FOOTER LINKS */

.footer-links h3,
.footer-contact h3{
    color:#C6A15B;
    margin-bottom:16px;
}


.footer-links a{
    display:block;

    color:#E8E8E8;

    text-decoration:none;

    margin-bottom:9px;

    transition:.3s;
}


.footer-links a:hover{
    color:#C6A15B;
    padding-left:5px;
}


/* CONTACT */

.footer-contact p{
    margin-bottom:10px;
    color:#E8E8E8;
}


.footer-contact i{
    color:#C6A15B;
    margin-right:8px;
}


/* FOOTER BOTTOM */

.footer-bottom{
    text-align:center;

    padding-top:18px;

    color:#ddd;

    font-size:14px;
}
    </style>
</head>
<body>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="nav">

    <!-- LOGO -->
    <div class="logo">
        <img src="logo.jpeg" alt="PawConnect Logo">
        <h2>PawConnect</h2>
    </div>


    <!-- CENTER MENU -->
    <div class="menu">

        <a href="home.php">HOME</a>

        <a href="about.php">ABOUT US</a>

        <div class="dropdown">

            <a href="#">
                EXPLORE
                <i class="fa-solid fa-chevron-down"></i>
            </a>

            <div class="dropdown-content">

                <div class="column">
                    <h3>About</h3>

                    <a href="about.php">About Us</a>
                    <a href="mission.php">Mission</a>
                    <a href="contact.php">Contact</a>
                </div>

                <div class="column">
                    <h3>Adoption</h3>

                    <a href="animals.php">Available Animals</a>
                    <a href="care.php">Care After Adoption</a>
                    <a href="stories.php">Adoption Stories</a>
                </div>

                <div class="column">
                    <h3>Login</h3>

                    <a href="login.php">User Login</a>
                    <a href="ngo_login.php">NGO Login</a>
                    <a href="admin_login.php">Admin Login</a>
                </div>

            </div>

        </div>

        <a href="animals.php">ANIMALS</a>
        <a href="<?php
            echo isset($_SESSION['user_id'])
                ? 'user_dashboard.php'
                : 'login.php';
        ?>">
            DASHBOARD
        </a>

    </div>


    <!-- RIGHT SIDE -->
    <div class="nav-actions">

        <?php if (isset($_SESSION['user_id'])) { ?>

            <a href="logout.php" class="login-btn">
                LOGOUT
            </a>

        <?php } ?>

    </div>

</div>






<!-- ================= HERO ================= -->
<div class="hero-section">
<section class="hero">

<div class="hero-text">

<h1>Our Mission</h1>

<h3>
Every Life Matters. Every Paw Counts.
<i class="fa-solid fa-paw"></i>
</h3>

<p>
At PawConnect, our mission is to rescue,
protect and rehabilitate animals in need and
connect them with responsible, loving families.
</p>

<p>
We believe every animal deserves a second
chance and a forever home.
</p>

<div class="mission-box">

<div class="box">

<div class="hero-icon">

<i class="fa-solid fa-hand-holding-heart"></i>

</div>

<div>

<h4>Rescue</h4>

<p>We save animals in need.</p>

</div>

</div>

<div class="box">

<div class="hero-icon">

<i class="fa-solid fa-heart-circle-plus"></i>

</div>

<div>

<h4>Care</h4>

<p>Medical care & love.</p>

</div>

</div>

<div class="box">

<div class="hero-icon">

<i class="fa-solid fa-house"></i>

</div>

<div>

<h4>Rehome</h4>

<p>Find forever homes.</p>

</div>

</div>

</div>

</div>

<div class="hero-image">

<img src="missiondc.jpeg" alt="Dog and Cat">

</div>

</section>
</div>

<!-- Next Part Starts Here -->

<!--================== Mission Pillars ==================-->
<section class="mission-section">
<div class="mission-pillars">
    <div class="title">
        <h2>Our Mission Pillars</h2>
        <div class="line"></div>
    </div>

    <div class="pillar-container">

        <!-- Card 1 -->
        <div class="pillar-card">
            <div class="pillar-icon">
                <i class="fa-solid fa-hand-holding-heart"></i>
            </div>

            <h3>Rescue</h3>

            <p>
                We rescue abandoned, injured and homeless animals from
                streets and unsafe environments.
            </p>
        </div>

        <!-- Card 2 -->
        <div class="pillar-card">
            <div class="pillar-icon">
                <i class="fa-solid fa-briefcase-medical"></i>
            </div>

            <h3>Rehabilitate</h3>

            <p>
                Providing medical care, food, shelter and emotional
                support until recovery.
            </p>
        </div>

        <!-- Card 3 -->
        <div class="pillar-card">
            <div class="pillar-icon">
                <i class="fa-solid fa-house-user"></i>
            </div>

            <h3>Rehome</h3>

            <p>
                Connecting rescued pets with loving and responsible
                families through smart adoption.
            </p>
        </div>

        <!-- Card 4 -->
        <div class="pillar-card">
            <div class="pillar-icon">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>

            <h3>Educate</h3>

            <p>
                Promoting responsible pet parenting and spreading
                awareness about animal welfare.
            </p>
        </div>

        <!-- Card 5 -->
        <div class="pillar-card">
            <div class="pillar-icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <h3>Support</h3>

            <p>
                Working with NGOs, volunteers and communities to build
                a stronger rescue network.
            </p>
        </div>

    </div>
</div>
</section>

<!--================ Mission Impact ================-->

<section class="mission-impact-section">

<div class="mission-impact">
<div class="title">
    <h2>Our Mission Impact</h2>
    <div class="line"></div>
 </div>
    <div class="impact-container">

        <div class="impact-card">
            <div class="impact-icon">
                <i class="fa-solid fa-paw"></i>
            </div>

            <h3>1200+</h3>
            <p>Animals Rescued</p>
        </div>

        <div class="impact-card">
            <div class="impact-icon">
                <i class="fa-solid fa-heart"></i>
            </div>

            <h3>750+</h3>
            <p>Successful Adoptions</p>
        </div>

        <div class="impact-card">
            <div class="impact-icon">
                <i class="fa-solid fa-kit-medical"></i>
            </div>

            <h3>3000+</h3>
            <p>Medical Treatments</p>
        </div>

        <div class="impact-card">
            <div class="impact-icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <h3>100+</h3>
            <p>NGO & Shelter Partners</p>
        </div>

    </div>
</div>
</section>
<!-- =====================================================
     FOOTER
===================================================== -->

<footer class="footer">

    <div class="footer-top">


        <!-- PAWCONNECT BRAND -->

        <div class="footer-about">

            <div class="footer-logo">

                <img src="logo.jpeg"
                     alt="PawConnect Logo">

                <h2>
                    PawConnect
                </h2>

            </div>


            <p>
                Connecting rescued animals with loving families,
                trusted shelters and compassionate hearts across India.
            </p>


            <div class="social-icons">

                <a href="#" aria-label="Facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>

                <a href="#" aria-label="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>

                <a href="#" aria-label="X">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>

                <a href="#" aria-label="LinkedIn">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>

            </div>

        </div>



        <!-- EXPLORE -->

        <div class="footer-links">

            <h3>
                Explore
            </h3>

            <a href="home.php">
                Home
            </a>

            <a href="animals.php">
                Available Animals
            </a>

            <a href="adopt.php">
                Adoption
            </a>

            <a href="stories.php">
                Adoption Stories
            </a>

        </div>



        <!-- SERVICES -->

        <div class="footer-links">

            <h3>
                Services
            </h3>

            <a href="care.php">
                Care After Adoption
            </a>

            <a href="petcare.php">
                Pet Care
            </a>

            <a href="ngo-partners.php">
                NGO Partners
            </a>

            <a href="mission.php">
                Our Mission
            </a>

        </div>



        <!-- CONTACT -->

        <div class="footer-contact">

            <h3>
                Contact
            </h3>

            <p>
                <i class="fa-solid fa-location-dot"></i>
                Pune, Maharashtra
            </p>

            <p>
                <i class="fa-solid fa-phone"></i>
                +91 98765 43210
            </p>

            <p>
                <i class="fa-solid fa-envelope"></i>
                hello@pawconnect.in
            </p>

        </div>


    </div>



    <!-- FOOTER BOTTOM -->

    <div class="footer-bottom">

        <p>
            © 2026 PawConnect • Connecting every paw with care,
            compassion & a place to belong.
        </p>

    </div>


</footer>
</body>
</html>