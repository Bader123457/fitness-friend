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
            display: block;
            grid-template-columns: 1fr;
            height: auto;
        }

        .dashboard img {
            display: flex;
            width: 100%;
        }

        .content {
            height: auto;
            display: grid;
            grid-template-rows: auto 1fr;
            padding: 30px;
            gap: 30px;
            overflow-y: visible;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .button-container{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            justify-content: center;
        }

        button.main_button {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 25px 15px;
            border-radius: 10px;
            background: linear-gradient(145deg, #1e1e1e, #2a2a2a);
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        button.main_button::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 8px; /* Slightly smaller than the button */
            background: gold;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        button.main_button:hover {
            transform: scale(1.05);
        }

        button.main_button:hover::after{
            opacity: 1;
        }

        button.main_button h2 {
            color: gold;
            font-size: 22px;
            margin-bottom: 10px;
            transition: color 0.3s ease;
            position: relative;
            z-index: 1;
        }

        button.main_button p {
            color: #ccc;
            font-size: 16px;
            transition: color 0.3s ease;
            position: relative;
            z-index: 1;
        }

        button.main_button p {
            color: #ccc;
            font-size: 16px;
            transition: color 0.3s ease;
            position: relative;
            z-index: 1;
        }

        button.main_button i {
            color: gold;
            margin-bottom: 10px;
            transition: color 0.3s ease;
            position: relative;
            z-index: 1;
        }

        button.main_button:hover h2,
        button.main_button:hover p,
        button.main_button:hover i {
            color: black;
        }

        .user-info-container {
            background-color: #1a1a1a;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            border-left: 4px solid gold;
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

        .main_button i {
            color: gold;
            margin-bottom: 10px;
            transition: 0.3s;
        }

        .main_button:hover i {
            color: black;
        }

        .slideshow img:first-child {
            opacity: 0.2;
        }

        .button-container #logout {
            grid-column: 1 / -1; 
            max-width: 280px; 
            justify-self: center; 
            margin: 0 auto; 
        }
    </style>
</head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<body>
    <header style="background: #111; padding: 10px 20px; display: flex; align-items: center; justify-content: space-between;">
        <img src="/assets/imgs/Logo.png" alt="FitnessBro Logo" style="height: 40px;">
        <div style="color: gold; font-weight: bold;"><?php echo $welcome_display; ?></div>
    </header>
    <div class="slideshow">
        <img src="/assets/imgs/dashboard_image1.jpg" class="active" alt="Fitness Background">
        <img src="/assets/imgs/dashboard_image2.jpg" alt="Workout Background">
        <img src="/assets/imgs/dashboard_image3.jpg" alt="Healthy Living Background">
    </div>

    <div class="dashboard">
        
        <main class="content">

            <div class="user-info-container">
                <h2 style="text-align: center; color: gold; margin-top: 0px;">About You</h2>
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
                    <i class = 'fas fa-calculator fa-2x'></i>
                    <h2>Calorie Calculator</h2>
                    <p>Track your calorie intake for better fitness results.</p>
                </button>
                
                <button class="main_button" id="meal" onclick="window.location.href = <?php echo $food_uri; ?>;">
                    <i class = 'fas fa-utensils fa-2x'></i>
                    <h2>Meal Plans</h2>
                    <p>Get a meal plan based on your fitness goal.</p>
                </button>

                <button class="main_button" id="workout">
                    <i class="fas fa-dumbbell fa-2x"></i>
                    <h2>Workout Plans</h2>
                    <p>Select your training days and view guided workout videos.</p>
                </button>
                
                <button class="main_button" id="profile" onclick="window.location.href = <?php echo $profile_uri; ?>;">
                    <i class="fas fa-user fa-2x"></i>
                    <h2>Profile</h2>
                    <p>Manage all of your account details.</p>
                </button>
                
                <button class="main_button" id="logout" onclick="window.location.href = <?php echo $logout_uri; ?>;">
                    <i class="fas fa-sign-out-alt fa-2x"></i>
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
