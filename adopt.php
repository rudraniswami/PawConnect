<?php

session_start();
include "db.php";


/* ================================
   CHECK LOGIN
================================ */

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();

}


/* ================================
   CHECK ANIMAL ID
================================ */

if (!isset($_GET['animal_id'])) {

    die("No animal selected.");

}

$animal_id = intval($_GET['animal_id']);


/* ================================
   GET ANIMAL
================================ */

$stmt = $conn->prepare(
    "SELECT * FROM animals WHERE id = ?"
);

if (!$stmt) {

    die("Database error: " . $conn->error);

}

$stmt->bind_param("i", $animal_id);

$stmt->execute();

$result = $stmt->get_result();


if ($result->num_rows == 0) {

    die("Animal not found. ID = " . $animal_id);

}


$pet = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>
Adopt <?php echo htmlspecialchars($pet['name']); ?> | PawConnect
</title>

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="stylesheet"
      href="adopt.css">

</head>


<body>


<!-- ================================
     NAVBAR
================================ -->

<div class="nav">

    <div class="logo">

        <img src="logo.jpeg"
             alt="PawConnect Logo">

        <h2>
            PawConnect
        </h2>

    </div>


    <div class="menu">

        <a href="home.php">
            HOME
        </a>

        <a href="animals.php">
            ANIMALS
        </a>


        <div class="dropdown">

            <a href="#">

                EXPLORE

                <i class="fa-solid fa-chevron-down"></i>

            </a>


            <div class="dropdown-content">


                <div class="column">

                    <h3>
                        About
                    </h3>

                    <a href="about.php">
                        About Us
                    </a>

                    <a href="mission.php">
                        Mission
                    </a>

                    <a href="contact.php">
                        Contact
                    </a>

                </div>


                <div class="column">

                    <h3>
                        Adoption
                    </h3>

                    <a href="animals.php">
                        Available Animals
                    </a>

                    <a href="care.php">
                        Care After Adoption
                    </a>

                    <a href="stories.php">
                        Adoption Stories
                    </a>

                </div>


                <div class="column">

                    <h3>
                        NGO
                    </h3>

                    <a href="ngo_login.php">
                        NGO Login
                    </a>

                    <a href="ngo_register.php">
                        Register NGO
                    </a>

                    <a href="admin_login.php">
                        Admin Login
                    </a>

                </div>

            </div>

        </div>


        <a href="adopt.php?animal_id=<?php echo $animal_id; ?>">
            ADOPT
        </a>


        <a href="contact.php">
            CONTACT
        </a>

    </div>


    <?php if (isset($_SESSION["user_id"])) { ?>

        <a href="logout.php"
           class="login-btn">

            LOGOUT

        </a>

    <?php } else { ?>

        <a href="login.php"
           class="login-btn">

            LOGIN

        </a>

    <?php } ?>

</div>



<!-- ================================
     PAGE HEADER
================================ -->

<section class="adopt-header">

    <p>
        PAWCONNECT ADOPTION
    </p>

    <h1>
        Give a Paw a Place to Call Home
    </h1>

    <span>
        A little information about you helps us
        find the right match for every companion.
    </span>

</section>



<!-- ================================
     SELECTED ANIMAL
================================ -->

<section class="selected-pet">


    <div class="pet-image">

        <img src="<?php echo htmlspecialchars($pet['image']); ?>"
             alt="<?php echo htmlspecialchars($pet['name']); ?>">

    </div>


    <div class="pet-info">

        <p>
            YOU ARE APPLYING TO ADOPT
        </p>


        <h2>
            <?php echo htmlspecialchars($pet['name']); ?>
        </h2>


        <h3>
            <?php echo htmlspecialchars($pet['breed']); ?>
        </h3>


        <div class="pet-details">

            <span>

                <i class="fa-solid fa-cake-candles"></i>

                <?php echo htmlspecialchars($pet['age']); ?>

            </span>


            <span>

                <i class="fa-solid fa-venus-mars"></i>

                <?php echo htmlspecialchars($pet['gender'] ?? 'Not specified'); ?>

            </span>

        </div>


        <p class="pet-note">

            You don't need to enter
            <?php echo htmlspecialchars($pet['name']); ?>'s
            information again. We already have it.

        </p>

    </div>

</section>



<!-- ================================
     FORM
================================ -->

<section class="form-section">


    <div class="form-heading">

        <p>
            ADOPTION APPLICATION
        </p>

        <h2>
            Tell us about yourself
        </h2>

        <span>
            Your answers help PawConnect understand
            whether you can provide a safe and caring home.
        </span>

    </div>



<form action="submit_adoption.php"
      method="POST">


    <!-- IMPORTANT -->

    <input type="hidden"
           name="animal_id"
           value="<?php echo $animal_id; ?>">



    <!-- ============================
         ABOUT YOU
    ============================= -->

    <div class="form-card">


        <div class="section-title">

            <span>
                01
            </span>

            <div>

                <h3>
                    About You
                </h3>

                <p>
                    Basic information about the person adopting.
                </p>

            </div>

        </div>


        <div class="form-grid">


            <div class="input-group">

                <label>
                    Full Name
                </label>

                <input type="text"
                       name="full_name"
                       placeholder="Enter your full name"
                       required>

            </div>


            <div class="input-group">

                <label>
                    Phone Number
                </label>

                <input type="tel"
                       name="phone"
                       placeholder="Enter your phone number"
                       required>

            </div>


            <div class="input-group">

                <label>
                    Email Address
                </label>

                <input type="email"
                       name="email"
                       placeholder="Enter your email"
                       required>

            </div>


            <div class="input-group">

                <label>
                    City
                </label>

                <input type="text"
                       name="city"
                       placeholder="e.g. Pune"
                       required>

            </div>

        </div>

    </div>



    <!-- ============================
         HOME
    ============================= -->

    <div class="form-card">


        <div class="section-title">

            <span>
                02
            </span>

            <div>

                <h3>
                    Your Home
                </h3>

                <p>
                    Help us understand the environment
                    your new companion will live in.
                </p>

            </div>

        </div>


        <div class="form-grid">


            <div class="input-group">

                <label>
                    What type of home do you live in?
                </label>

                <select name="home_type"
                        required>

                    <option value="">
                        Select
                    </option>

                    <option value="Own House">
                        Own House
                    </option>

                    <option value="Own Flat">
                        Own Flat
                    </option>

                    <option value="Rented House">
                        Rented House
                    </option>

                    <option value="Rented Flat">
                        Rented Flat
                    </option>

                </select>

            </div>


            <div class="input-group">

                <label>
                    Do you own your home?
                </label>

                <select name="owns_home"
                        required>

                    <option value="">
                        Select
                    </option>

                    <option value="Yes">
                        Yes
                    </option>

                    <option value="No">
                        No
                    </option>

                </select>

            </div>


            <div class="input-group">

                <label>
                    Do you have other pets?
                </label>

                <select name="other_pets"
                        required>

                    <option value="">
                        Select
                    </option>

                    <option value="No">
                        No
                    </option>

                    <option value="Yes">
                        Yes
                    </option>

                </select>

            </div>


            <div class="input-group">

                <label>
                    Is your home pet-friendly?
                </label>

                <select name="pet_friendly"
                        required>

                    <option value="">
                        Select
                    </option>

                    <option value="Yes">
                        Yes
                    </option>

                    <option value="No">
                        No
                    </option>

                </select>

            </div>

        </div>

    </div>



    <!-- ============================
         TIME & CARE
    ============================= -->

    <div class="form-card">


        <div class="section-title">

            <span>
                03
            </span>

            <div>

                <h3>
                    Time & Care
                </h3>

                <p>
                    Every pet needs attention, companionship
                    and daily care.
                </p>

            </div>

        </div>


        <div class="form-grid">


            <div class="input-group">

                <label>
                    How much time can you spend daily?
                </label>

                <select name="time_available"
                        required>

                    <option value="">
                        Select
                    </option>

                    <option value="1-2 hours">
                        1–2 hours
                    </option>

                    <option value="2-4 hours">
                        2–4 hours
                    </option>

                    <option value="4-6 hours">
                        4–6 hours
                    </option>

                    <option value="6+ hours">
                        6+ hours
                    </option>

                </select>

            </div>


            <div class="input-group full">

                <label>
                    Who will care for the pet when you are away?
                </label>

                <input type="text"
                       name="caretaker"
                       placeholder="e.g. Family member, pet sitter">

            </div>

        </div>

    </div>



    <!-- ============================
         FINANCIAL
    ============================= -->

    <div class="form-card">


        <div class="section-title">

            <span>
                04
            </span>

            <div>

                <h3>
                    Financial Readiness
                </h3>

                <p>
                    Caring for a pet includes regular food,
                    healthcare and other expenses.
                </p>

            </div>

        </div>


        <div class="form-grid">


            <div class="input-group">

                <label>
                    Monthly income range
                </label>

                <select name="income_range"
                        required>

                    <option value="">
                        Select
                    </option>

                    <option value="Below ₹20,000">
                        Below ₹20,000
                    </option>

                    <option value="₹20,000 - ₹40,000">
                        ₹20,000 – ₹40,000
                    </option>

                    <option value="₹40,000 - ₹70,000">
                        ₹40,000 – ₹70,000
                    </option>

                    <option value="₹70,000+">
                        ₹70,000+
                    </option>

                    <option value="Prefer not to say">
                        Prefer not to say
                    </option>

                </select>

            </div>


            <div class="input-group">

                <label>
                    Comfortable monthly pet-care budget
                </label>

                <select name="monthly_budget"
                        required>

                    <option value="">
                        Select
                    </option>

                    <option value="Below ₹2,000">
                        Below ₹2,000
                    </option>

                    <option value="₹2,000 - ₹5,000">
                        ₹2,000 – ₹5,000
                    </option>

                    <option value="₹5,000 - ₹10,000">
                        ₹5,000 – ₹10,000
                    </option>

                    <option value="₹10,000+">
                        ₹10,000+
                    </option>

                </select>

            </div>


            <div class="input-group full">

                <label>
                    Are you prepared for veterinary and emergency expenses?
                </label>

                <select name="ready_for_expenses"
                        required>

                    <option value="">
                        Select
                    </option>

                    <option value="Yes">
                        Yes, I am prepared
                    </option>

                    <option value="No">
                        No
                    </option>

                    <option value="Need more information">
                        I need more information
                    </option>

                </select>

            </div>

        </div>

    </div>



    <!-- ============================
         ADOPTION STORY
    ============================= -->

    <div class="form-card">


        <div class="section-title">

            <span>
                05
            </span>

            <div>

                <h3>
                    Your Adoption Story
                </h3>

                <p>
                    Tell us what makes you ready to welcome a pet.
                </p>

            </div>

        </div>


        <div class="input-group">

            <label>
                Have you had a pet before?
            </label>

            <select name="previous_pet"
                    required>

                <option value="">
                    Select
                </option>

                <option value="No">
                    No
                </option>

                <option value="Yes">
                    Yes
                </option>

            </select>

        </div>


        <br>


        <div class="input-group">

            <label>

                Why would you like to adopt
                <?php echo htmlspecialchars($pet['name']); ?>?

            </label>


            <textarea name="reason"
                      rows="5"
                      placeholder="Tell us a little about why you want to adopt..."
                      required></textarea>

        </div>

    </div>



    <!-- ============================
         AGREEMENT
    ============================= -->

    <div class="agreement">

        <label>

            <input type="checkbox"
                   name="agreement"
                   value="1"
                   required>

            <span>

                I understand that adoption is a long-term
                responsibility and I am ready to provide
                a safe, caring and supportive home.

            </span>

        </label>

    </div>



    <!-- ============================
         SUBMIT
    ============================= -->

    <button type="submit"
            class="submit-btn">

        Submit Adoption Request

        <i class="fa-solid fa-arrow-right"></i>

    </button>


</form>

</section>



<!-- ================================
     FOOTER
================================ -->

<footer class="footer">


    <div class="footer-top">


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

        </div>



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

            <a href="adopt.php?animal_id=<?php echo $animal_id; ?>">
                Adoption
            </a>

            <a href="stories.php">
                Adoption Stories
            </a>

        </div>



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



    <div class="footer-bottom">

        <p>

            © 2026 PawConnect • Connecting every paw with care,
            compassion & a place to belong.

        </p>

    </div>

</footer>


</body>
</html>