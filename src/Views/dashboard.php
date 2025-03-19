<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitnessBro - Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #0d0d0d;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .slideshow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .slideshow img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 3s ease-in-out;
        }

        .slideshow img.active {
            opacity: 0.2;
        }

        .dashboard {
            display: flex;
            height: 100vh;
        }

        .dashboard img {
            display: flex;
            width: 100%;
        }

        .sidebar {
            background: #111;
            color: gold;
            padding: 20px;
            width: 250px;
            height: 100vh;
        }

        .sidebar h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: gold;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px 0;
        }

        .sidebar ul li a {
            color: gold;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: 0.3s;
            display: block;
            padding: 10px;
        }

        .sidebar ul li a:hover {
            background: gold;
            color: black;
            border-radius: 5px;
        }

        .content .button-container{
            flex: 1;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;    
            justify-content: center;
            align-items: flex-start;
        }

        button.main_button {
            background: #222;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(255, 215, 0, 0.3);
            width: 250px;
            text-align: center;
            transition: all 0.3s ease;
        }

        button.main_button:hover {
            background: gold;
            color: black;
            transform: scale(1.1);
        }

        button.main_button h2 {
            color: gold;
            font-size: 22px;
            margin-bottom: 10px;
            transition: 0.3s;
        }

        button.main_button:hover h2 {
            color: black;
        }

        button.main_button p {
            color: #ccc;
            font-size: 16px;
            transition: 0.3s;
        }

        button.main_button:hover p {
            color: black;
            font-size: 18px;
        }

        button {
            background: gold;
            color: black;
            border: none;
            padding: 10px 15px;
            margin-top: 10px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            transition: 0.3s;
        }

        button:hover {
            background: #e0b707;
        }

        .content {
            margin: auto;
        }

        .content .user-info-container {
            width: 85%;
            margin: 20px auto;
            padding: 20px 30px 30px 30px;
            background-color: #1a1a1a; 
            border-radius: 15px; 
            box-shadow: 0px 4px 10px rgba(255, 215, 0, 0.3);
        }

        .user-info {
            display: grid;
            grid-template-columns: 1fr 1fr; 
            grid-column-gap: 15%;
            grid-row-gap: 20px;
            font-family: Arial, sans-serif;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info-item strong {
            font-weight: bold;
            color: gold;
        }

        .info-item span {
            color: white;
        }
    </style>
</head>
<body>
    <div class="slideshow">
        <img src="/assets/imgs/dashboard_image1.jpg" class="active" alt="Fitness Background">
        <img src="/assets/imgs/dashboard_image2.jpg" alt="Workout Background">
        <img src="/assets/imgs/dashboard_image3.jpg" alt="Healthy Living Background">
    </div>

    <div class="dashboard">
        <div class="sidebar">
            <img src="/assets/imgs/Logo.png" alt="FitnessBro Logo">
            <h2>Username: <?php echo $welcome_display; ?></h2>
            <ul>
                <li><a href=<?php echo $calorie_uri; ?>>Calorie Calculator</a></li>
                <li><a href=<?php echo $food_uri; ?>>Meal Plans</a></li>
                <li><a href="#">Workout Plans</a></li>
                <li><a href=<?php echo $profile_uri; ?>>Profile</a></li>
                <li><a href=<?php echo $logout_uri; ?>>Logout</a></li>
            </ul>
        </div>
        
        <main class="content">

            <div class="user-info-container">
                <h2 style="text-align: center; color: gold; margin-top: 0px;">User Information</h2>
                <?php if ($error_msg_display === False): ?>
                <div class="user-info">
                    <div class="info-item">
                        <strong>Name:</strong>
                        <span><?php echo $full_name;?></span>
                    </div>
                    <div class="info-item">
                        <strong>Email:</strong>
                        <span><?php echo $email;?></span>
                    </div>
                    <div class="info-item">
                        <strong>Age:</strong>
                        <span><?php echo $age;?></span>
                    </div>
                    <div class="info-item">
                        <strong>Gender:</strong>
                        <span><?php echo $gender_display;?></span>
                    </div>
                    <div class="info-item">
                        <strong>Height:</strong>
                        <span><?php echo $height;?>cm</span>
                    </div>
                    <div class="info-item">
                        <strong>Weight:</strong>
                        <span><?php echo $weight;?>kg</span>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($error_msg_display) include_once __DIR__ . '/error_msg_template'?>
            </div>

            <div class="button-container">
                <button class="main_button" id="calories" onclick="window.location.href = <?php echo $calorie_uri; ?>;">
                    <h2>Calorie Calculator</h2>
                    <p>Track your calorie intake for better fitness results.</p>
                </button>
                
                <button class="main_button" id="meal" onclick="window.location.href = <?php echo $food_uri; ?>;">
                    <h2>Meal Plans</h2>
                    <p>Get a meal plan based on your fitness goal.</p>
                </button>

                <button class="main_button" id="workout">
                    <h2>Workout Plans</h2>
                    <p>Select your training days and view guided workout videos.</p>
                </button>
                
                <button class="main_button" id="profile" onclick="window.location.href = <?php echo $profile_uri; ?>;">
                    <h2>Profile</h2>
                    <p>Manage all of your account details.</p>
                </button>
                
                <button class="main_button" id="logout" onclick="window.location.href = <?php echo $logout_uri; ?>;">
                    <h2>Logout</h2>
                    <p>Securely log out of your account.</p>
                </button>
            </div>
        </main>
    </div>

    <script>
        let index = 0;
        const images = document.querySelectorAll('.slideshow img');

        function changeImage() {
            images.forEach(img => img.classList.remove('active'));
            images[index].classList.add('active');
            index = (index + 1) % images.length;
        }

        setInterval(changeImage, 5000);
    </script>
</body>
</html>
