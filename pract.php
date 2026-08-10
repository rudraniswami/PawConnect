<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animals | PawConnect</title>

    <link rel="stylesheet" href="animals.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="pract.css">
</head>

<body>

<!-- Navbar -->


<!-- ================= HERO ================= -->

<section class="hero">

    <div class="hero-content">

        <h1>Every Paw Has A Story</h1>

        <p>
            Meet loving companions waiting to find
            their forever family.
        </p>

        <a href="#animals" class="btn">
            Meet Friends
        </a>

    </div>

    <div class="hero-image">

        <img src="images/dog.png">

    </div>

</section>


<!-- SEARCH -->

<section class="search">

    <h2>Find Your Companion</h2>

    <div class="search-box">

        <input
        type="text"
        placeholder="Search by breed or name">

        <button>
            Search
        </button>

    </div>

</section>



<!-- MOOD FILTERS -->

<section class="moods">

<h2>Choose By Personality</h2>

<div class="mood-container">

<div class="mood-card">
😊
<span>Playful</span>
</div>

<div class="mood-card">
😌
<span>Calm</span>
</div>

<div class="mood-card">
🏃
<span>Active</span>
</div>

<div class="mood-card">
👶
<span>Kid Friendly</span>
</div>

<div class="mood-card">
🏡
<span>Apartment</span>
</div>

<div class="mood-card">
❤️
<span>Loyal</span>
</div>

</div>

</section>



<!-- FEATURED PETS -->

<section class="featured" id="animals">

<h2>Featured Friends</h2>

<div class="pet-grid">

<!-- CARD -->

<div class="pet-card">

<img src="images/dog1.jpg">

<div class="pet-info">

<h3>Bella</h3>

<p>Golden Retriever</p>

<div class="badges">

<span>Vaccinated</span>

<span>Friendly</span>

<span>2 Years</span>

</div>

<p class="story">
Waiting patiently for
a loving home.
</p>

<a href="">
Meet Bella
</a>

</div>

</div>



<div class="pet-card">

<img src="images/cat1.jpg">

<div class="pet-info">

<h3>Luna</h3>

<p>Persian Cat</p>

<div class="badges">

<span>Indoor</span>

<span>Healthy</span>

<span>1 Year</span>

</div>

<p class="story">

Loves peaceful naps
and cuddles.

</p>

<a href="">
Meet Luna
</a>

</div>

</div>



<div class="pet-card">

<img src="images/dog2.jpg">

<div class="pet-info">

<h3>Bruno</h3>

<p>Labrador</p>

<div class="badges">

<span>Energetic</span>

<span>Healthy</span>

<span>3 Years</span>

</div>

<p class="story">

Always excited for
morning walks.

</p>

<a href="">
Meet Bruno
</a>

</div>

</div>

</div>

</section>



<!-- RECENT RESCUES -->

<section class="rescues">

<h2>Recently Rescued</h2>

<div class="rescue-slider">

<div class="rescue-card"></div>

<div class="rescue-card"></div>

<div class="rescue-card"></div>

<div class="rescue-card"></div>

</div>

</section>



<!-- HAPPY TAILS -->

<section class="stories">

<h2>Happy Tails</h2>

<div class="story-container">

<div class="story-card">

<h3>Bruno's Journey</h3>

<p>

From lonely streets
to a forever family.

</p>

</div>

<div class="story-card">

<h3>Luna's Smile</h3>

<p>

Found love after
waiting 6 months.

</p>

</div>

</div>

</section>



<!-- MATCH SECTION -->

<section class="match">

<div class="match-content">

<h2>

Find Your Perfect Match

</h2>

<p>

Answer a few simple
questions and discover
the pet that matches
your lifestyle.

</p>

<a href="">
Start Matching
</a>

</div>

</section>



<!-- STATISTICS -->

<section class="stats">

<div class="stat">

<h2>180+</h2>

<p>

Successful
Adoptions

</p>

</div>

<div class="stat">

<h2>75</h2>

<p>

Dogs Waiting

</p>

</div>

<div class="stat">

<h2>48</h2>

<p>

Cats Waiting

</p>

</div>

<div class="stat">

<h2>120+</h2>

<p>

Happy Families

</p>

</div>

</section>



<!-- FOOTER -->

</body>
</html>