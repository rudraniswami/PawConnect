<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Document</title>
</head>
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


/* ================= HERO SECTION ================= */

/* HERO SECTION */

.hero{
    width:100%;
    height:260px;
    background:#fbf7f0;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:40px 70px;
    overflow:hidden;
    position:relative;
}

.hero::before{
    content:"";
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:url("leaf-bg.png") no-repeat right center;
    background-size:320px;
    opacity:0.18;
}

.hero-text{
    width:45%;
    z-index:2;
}

.hero-text h1{
    font-size:72px;
    color:#0f4b35;
    margin-bottom:15px;
    font-weight:bold;
}

.hero-text span{
    color:#c79a3b;
}

.hero-text p{
    font-size:26px;
    color:#555;
}

.hero-image{
    position:absolute;
    right:0;
    bottom:0;
    width:48%;
}

.adopt-hero{
    position:relative;
}.adopt-hero{
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    height: 330px;
    background: #fdf9f2;
    overflow: hidden;
    padding: 0 70px;
}

.hero-text{
    width: 45%;
    z-index: 2;
}

.hero-text h1{
    font-size: 65px;
    color: #123C2A;
    margin-bottom: 15px;
}

.hero-text p{
    font-size: 24px;
    color: #555;
}

.hero-image{
    position: absolute;
    right: 0;
    bottom: 0;
    width: 50%;
    height: 100%;
}

.hero-image img{
    width: 100%;
    height: 100%;
    object-fit: contain;
    object-position: right bottom;
}
/* ================= SEARCH FILTER ================= */

.search-section{
    width:90%;
    margin:35px auto;
    display:flex;
    gap:18px;
    align-items:center;
    justify-content:center;
    flex-wrap:wrap;
}

.search-box,
.filter-box{
    background:#fff;
    border:1px solid #ddd;
    border-radius:12px;
    padding:15px 18px;
    display:flex;
    align-items:center;
    gap:12px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.search-box{
    flex:2;
    min-width:280px;
}

.filter-box{
    flex:1;
    min-width:180px;
}

.search-box i,
.filter-box i{
    color:#123C2A;
    font-size:18px;
}

.search-box input{
    border:none;
    outline:none;
    width:100%;
    font-size:16px;
    background:transparent;
}

.filter-box select{
    border:none;
    outline:none;
    width:100%;
    font-size:16px;
    background:transparent;
    cursor:pointer;
}

.search-btn{
    background:#123C2A;
    color:#fff;
    border:none;
    padding:15px 28px;
    border-radius:12px;
    font-size:16px;
    cursor:pointer;
    transition:.3s;
}

.search-btn:hover{
    background:#1c5a3d;
}

.search-btn i{
    margin-right:8px;
}
/* ================= PET CARDS ================= */

.pets-section{
    width:90%;
    margin:40px auto;
}

.section-title{
    font-size:34px;
    color:#123C2A;
    margin-bottom:25px;
}

.pets-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:25px;
}

.pet-card{
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    transition:.3s;
    position:relative;
}

.pet-card:hover{
    transform:translateY(-10px);
}

.pet-card img{
    width:100%;
    height:240px;
    object-fit:cover;
}

.status{
    position:absolute;
    top:15px;
    right:15px;
    background:#32b44a;
    color:#fff;
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
    font-weight:bold;
}

.pet-info{
    padding:18px;
}

.pet-info h3{
    color:#123C2A;
    margin-bottom:10px;
    font-size:28px;
}

.pet-info p{
    margin:8px 0;
    color:#555;
}

.pet-info i{
    color:#C6A15B;
    margin-right:8px;
}

.buttons{
    display:flex;
    justify-content:space-between;
    margin-top:18px;
}

.details-btn{
    text-decoration:none;
    padding:10px 16px;
    border:2px solid #123C2A;
    color:#123C2A;
    border-radius:10px;
    font-weight:bold;
}

.adopt-btn{
    text-decoration:none;
    background:#C6A15B;
    color:#fff;
    padding:10px 16px;
    border-radius:10px;
    font-weight:bold;
}

.adopt-btn:hover{
    background:#b08d49;
}
</style>
<body>

<!-- ================= NAVBAR ================= -->
<div class="nav">
    <div class="logo">
        <img src="logo.jpeg" alt="PawConnect Logo">
        <h2>PawConnect</h2>
    </div>

    <div class="menu">
        <a href="home.php">HOME</a>
        <a href="animals.php">ANIMALS</a>

        <div class="dropdown">

    <a href="#">
        EXPLORE <i class="fa-solid fa-chevron-down"></i>
    </a>

    <div class="dropdown-content">

        <!-- ABOUT -->

        <div class="column">

            <h3>About</h3>

            <a href="about.php">About Us</a>

            <a href="mission.php">Mission</a>

            <a href="contact.php">Contact</a>

        </div>


        <!-- ADOPTION -->

        <div class="column">

            <h3>Adoption</h3>

            <a href="animals.php">Available Animals</a>

            <a href="care.php">Care After Adoption</a>

            <a href="stories.php">Adoption Stories</a>

        </div>


        <!-- NGO -->

        <div class="column">

          <h3>NGO</h3>

            <a href="ngo_login.php">NGO Login</a>

            <a href="ngo_register.php">Register NGO</a>

            <a href="admin_login.php">Admin Login</a>

        </div>

    </div>

</div>

<a href="adopt.php">ADOPT</a>

<a href="contact.php">CONTACT</a></div>

    <?php if (isset($_SESSION["user_id"]) || isset($_SESSION["ngo_id"])) { ?>

    <a href="logout.php" class="login-btn">
        LOGOUT
    </a>

<?php } else { ?>

    <?php if (isset($_SESSION["user_id"]) || isset($_SESSION["ngo_id"])) { ?>

    <a href="logout.php" class="login-btn">
        LOGOUT
    </a>

<?php } else { ?>

    <a href="login.php" class="login-btn">
        LOGIN
    </a>

<?php } ?>

<?php } ?>
</div>
<!-- ================= HERO SECTION ================= -->

<section class="adopt-hero">

    <div class="hero-text">

        <h1>Adopt a Pet <span>♡</span></h1>

        <p>Give love. Get loyalty. Adopt your forever friend.</p>

    </div>

    <div class="hero-image">

        <img src="dogcat.jpeg" alt="Dog and Cat">

    </div>

</section>
<!-- ================= SEARCH FILTER ================= -->

<section class="search-section">

    <div class="search-box">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Search pets...">
    </div>

    <div class="filter-box">
        <i class="fa-solid fa-paw"></i>

        <select>
            <option>All Animals</option>
            <option>Dogs</option>
            <option>Cats</option>
            <option>Rabbits</option>
            <option>Birds</option>
        </select>
    </div>

    <div class="filter-box">
        <i class="fa-solid fa-calendar"></i>

        <select>
            <option>All Age</option>
            <option>Baby</option>
            <option>Young</option>
            <option>Adult</option>
        </select>
    </div>

    <div class="filter-box">
        <i class="fa-solid fa-location-dot"></i>

        <select>
            <option>All Location</option>
            <option>Pune</option>
            <option>Mumbai</option>
            <option>Nashik</option>
            <option>Nagpur</option>
        </select>
    </div>

    <button class="search-btn">
        <i class="fa-solid fa-magnifying-glass"></i>
        Search
    </button>

</section>
<!-- ================= AVAILABLE PETS ================= -->

<section class="pets-section">

    <h2 class="section-title">
        🐾 Available Pets
    </h2>

    <div class="pets-grid">

        <!-- Card 1 -->

        <div class="pet-card">

            <span class="status">Available</span>

            <img src="dog1.jpeg" alt="Dog">

            <div class="pet-info">

                <h3>Bruno</h3>

                <p><i class="fa-solid fa-dog"></i> Breed : Labrador</p>

                <p><i class="fa-solid fa-cake-candles"></i> Age : 2 Years</p>

                <p><i class="fa-solid fa-mars"></i> Gender : Male</p>

                <p><i class="fa-solid fa-location-dot"></i> Pune</p>

                <div class="buttons">

                    <a href="#" class="details-btn">View Details</a>

                    <a href="#" class="adopt-btn">Adopt Now</a>

                </div>

            </div>

        </div>

        <!-- Card 2 -->

        <div class="pet-card">

            <span class="status">Available</span>

            <img src="cat.jpeg" alt="Cat">

            <div class="pet-info">

                <h3>Luna</h3>

                <p><i class="fa-solid fa-cat"></i> Breed : Indie Cat</p>

                <p><i class="fa-solid fa-cake-candles"></i> Age : 1 Year</p>

                <p><i class="fa-solid fa-venus"></i> Gender : Female</p>

                <p><i class="fa-solid fa-location-dot"></i> Mumbai</p>

                <div class="buttons">

                    <a href="#" class="details-btn">View Details</a>

                    <a href="#" class="adopt-btn">Adopt Now</a>

                </div>

            </div>

        </div>

        <!-- Card 3 -->

        <div class="pet-card">

            <span class="status">Available</span>

            <img src="dog2.jpeg" alt="Rabbit">

            <div class="pet-info">

                <h3>Cocoa</h3>

                <p><i class="fa-solid fa-paw"></i> Breed : Rabbit</p>

                <p><i class="fa-solid fa-cake-candles"></i> Age : 8 Months</p>

                <p><i class="fa-solid fa-venus"></i> Gender : Female</p>

                <p><i class="fa-solid fa-location-dot"></i> Pune</p>

                <div class="buttons">

                    <a href="#" class="details-btn">View Details</a>

                    <a href="#" class="adopt-btn">Adopt Now</a>

                </div>

            </div>

        </div>

        <!-- Card 4 -->

        <div class="pet-card">

            <span class="status">Available</span>

            <img src="cat2.jpeg" alt="Dog">

            <div class="pet-info">

                <h3>Max</h3>

                <p><i class="fa-solid fa-dog"></i> Breed : Beagle</p>

                <p><i class="fa-solid fa-cake-candles"></i> Age : 1.5 Years</p>

                <p><i class="fa-solid fa-mars"></i> Gender : Male</p>

                <p><i class="fa-solid fa-location-dot"></i> Nashik</p>

                <div class="buttons">

                    <a href="#" class="details-btn">View Details</a>

                    <a href="#" class="adopt-btn">Adopt Now</a>

                </div>

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