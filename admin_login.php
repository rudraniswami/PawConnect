<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PawConnect Admin Login</title>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
      
<link rel="stylesheet"
href="admin_login.css">

</head>

<body>

    <div class="container">

        <!-- LEFT -->

        <div class="left">

            <div class="logo">
                <i class="fa-solid fa-paw"></i>
            </div>

            <h1>
                Paw<span>Connect</span>
            </h1>

            <p>
                Manage rescued animals, adoption activities,
                contact messages and your PawConnect platform.
            </p>

            <div class="admin">
                <i class="fa-solid fa-shield-halved"></i>
                Administrator Panel
            </div>

        </div>


        <!-- RIGHT -->

        <div class="right">

            <h2>Admin Login</h2>

            <p class="subtitle">
                Sign in to access your dashboard.
            </p>

            <form action="admin_login_process.php" method="POST">

                <label>Email Address</label>

                <div class="input">

                    <i class="fa-solid fa-envelope"></i>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter admin email"
                        required
                    >

                </div>


                <label>Password</label>

                <div class="input">

                    <i class="fa-solid fa-lock"></i>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter password"
                        required
                    >

                </div>


                <button type="submit">

                    <i class="fa-solid fa-right-to-bracket"></i>
                    Login to Dashboard

                </button>

            </form>


            <p class="secure">

                <i class="fa-solid fa-shield-halved"></i>
                Secure Administrator Login

            </p>

        </div>

    </div>

</body>

</html>