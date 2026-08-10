<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PawConnect Admin Login</title>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Times New Roman', serif;
        }

        body {
            background: #F8F3E8;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 850px;
            background: #FFFDF7;
            display: flex;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px #bbb;
        }

        /* LEFT SIDE */

        .left {
            width: 50%;
            background: #123C2A;
            color: white;
            text-align: center;
            padding: 70px 30px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: #C6A15B;
            color: #123C2A;
            border-radius: 50%;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 35px;
        }

        .left h1 {
            font-size: 38px;
            margin: 20px 0 10px;
        }

        .left h1 span {
            color: #E9DDBF;
        }

        .left p {
            color: #E9DDBF;
            line-height: 1.6;
            font-size: 16px;
        }

        .admin {
            display: inline-block;
            margin-top: 25px;
            padding: 8px 20px;
            border: 1px solid #C6A15B;
            border-radius: 20px;
        }

        /* RIGHT SIDE */

        .right {
            width: 50%;
            padding: 60px 50px;
        }

        .right h2 {
            color: #0B2419;
            font-size: 30px;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #66756C;
            margin-bottom: 25px;
        }

        label {
            display: block;
            color: #33483B;
            margin-bottom: 7px;
        }

        .input {
            position: relative;
            margin-bottom: 20px;
        }

        .input i {
            position: absolute;
            left: 15px;
            top: 14px;
            color: #123C2A;
        }

        input {
            width: 100%;
            padding: 13px 45px;
            border: 1px solid #D8CFBC;
            border-radius: 8px;
            outline: none;
        }

        input:focus {
            border-color: #C6A15B;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #123C2A;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #0B2419;
        }

        .secure {
            text-align: center;
            color: #66756C;
            font-size: 13px;
            margin-top: 20px;
        }

        /* MOBILE */

        @media(max-width: 700px) {

            .container {
                width: 90%;
                display: block;
            }

            .left,
            .right {
                width: 100%;
            }

            .left {
                padding: 40px 20px;
            }

            .right {
                padding: 40px 30px;
            }

        }

    </style>

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