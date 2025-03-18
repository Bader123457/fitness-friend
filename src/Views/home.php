<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Bro - Your Ultimate Fitness Guide</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #121212;
            color: white;
            font-family: 'Montserrat', sans-serif;
            text-align: center;
        }

        /* Navbar (Dashboard) */
        .navbar {
            width: 100%;
            height: 60px;
            background: rgba(0, 0, 0, 0.8);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            z-index: 100;
        }

        .navbar .logo {
            width: 180px;
        }

        .nav-buttons {
            display: flex;
            gap: 15px;
            cursor: pointer;
            user-select: none;
        }

        .nav-buttons a {
            text-decoration: none;
            color: gold;
            font-weight: bold;
            padding: 8px 15px;
            border: 2px solid gold;
            border-radius: 5px;
            transition: 0.3s;
        }

        .nav-buttons a:hover {
            background: gold;
            color: black;
        }

        /* Hero Section */
        .hero {
            width: 100%;
            height: 100vh;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            background: linear-gradient(to right, #1c1b1a, #ccc2b0);
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/assets/imgs/gymphoto.jpeg') no-repeat center center/cover;
            opacity: 0.2; /* 20% opacity */
            z-index: 1;
        }

        .hero .logo {
            width:500px;
            position:relative;
            left:26px;
            z-index:2;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            color: gold;
            z-index: 2;
            position: relative;
        }

        .hero p {
            font-size: 1.2rem;
            font-weight: 300;
            margin-top: 10px;
            z-index: 2;
            position: relative;
        }

        .cta-button {
            margin-top: 20px;
            padding: 12px 25px;
            background-color: gold;
            color: black;
            font-size: 1rem;
            font-weight: 700;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
            z-index: 2;
            position: relative;
        }

        .cta-button:hover {
            background-color: white;
            color: black;
            transform: scale(1.1);
        }

        /* CTA Section */
        .cta-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px 20px;
            background: linear-gradient(to right, #4a2900, #b88929);
            border-radius: 10px;
            margin: 40px auto;
            width: 95%;
        }

        .cta-section img {
            width: 600px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .cta-text {
            font-size: 24px;
            font-weight: bold;
            color: gold;
            max-width: 500px;
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            .hero p {
                font-size: 1rem;
            }
            .cta-text {
                font-size: 20px;
            }
            .cta-section img {
                width: 80%;
            }
            .nav-buttons a {
                padding: 6px 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar (Dashboard) -->
    <div class="navbar">
        <img src="/assets/imgs/LogoText.png" alt="Fitness Bro Logo Text" class="logo">
        <div class="nav-buttons">
            <a onclick="window.location.href = <?php echo $register_uri; ?>;">Register</a>
            <a onclick="window.location.href = <?php echo $login_uri; ?>;">Log In</a>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero">
        <img src="/assets/imgs/Logo.png" alt="Fitness Bro Logo" class="logo">
        <h1>Your Fitness Journey Starts Here</h1>
        <p>Train smarter, eat healthier, and transform your body.</p>
        <a href= <?php echo $register_uri; ?> class="cta-button">Start Today</a>
    </div>

    <!-- Call-To-Action Section -->
    <div class="cta-section">
        <img src="/assets/imgs/Tagline.png" alt="Fitness Motivation">
        <div class="cta-text">
            🚀 Push your limits, stay consistent, and achieve your fitness goals with expert guidance and proven methods.
        </div>
    </div>
</body>
</html>
