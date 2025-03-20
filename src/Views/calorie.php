<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitnessBro - Calorie Overview</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #1a1a1a;
            color: #e0e0e0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0px;
            display: flex;
            justify-content: center;
            min-height: 100vh;
        }
        
        h1 {
            color: #f5c518;
            margin-top: 0px;
            margin-bottom: 30px;
            text-align: center;
            font-size: 24px;
        }
        
        .container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
            box-sizing: border-box;
            align-content: center;
        }
        
        .dashboard {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            width: 100%;
            justify-content: center;
        }
        
        @media (max-width: 700px) {
            .dashboard {
                grid-template-columns: 1fr;
            }
        }
        
        .card {
            background-color: #222;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.7);
            width: 100%;
            box-sizing: border-box;
        }
        
        .card h2 {
            color: #f5c518;
            font-size: 18px;
            margin-top: 0;
            margin-bottom: 15px;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #333;
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .info-label {
            color: #aaa;
        }
        
        .info-value {
            font-weight: bold;
            color: #e0e0e0;
        }
        
        .highlight-box {
            background-color: #2a2a2a;
            padding: 15px;
            margin-top: 20px;
            border-left: 3px solid #f5c518;
        }
        
        .highlight-box h3 {
            color: #f5c518;
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 16px;
        }
        
        .progress-bar {
            height: 10px;
            background-color: #333;
            border-radius: 5px;
            margin: 15px 0;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background-color: #f5c518;
            width: <?php echo (string)$progress_width . '%';?>;
        }
        
        .bar-labels {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #888;
            margin-bottom: 15px;
        }
        
        i {
            margin-right: 5px;
            color: #f5c518;
        }
        
        .button-container {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 20px;
        }
        
        .back-button {
            background-color: #f5c518;
            color: #000;
            border: none;
            padding: 10px 20px;
            margin-bottom: 50px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.2s;
        }
        
        .back-button:hover {
            background-color: #e0b717;
        }

        .sidebar {
            background: #111;
            color: gold;
            padding: 20px;
            width: 228px;
            height: 100vh;
        }

        .sidebar h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            padding-left: 60px;
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

        .sidebar img{
            display: flex;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="/assets/imgs/Logo.png" alt="FitnessBro Logo">
        <h2> <?php echo $welcome_display; ?></h2>
        <ul>
            <li><a href=<?php echo $dashboard_uri; ?>>Dashboard</a></li>
            <li><a href=<?php echo $food_uri; ?>>Meal Plans</a></li>
            <li><a href="#">Workout Plans</a></li>
            <li><a href=<?php echo $profile_uri; ?>>Profile</a></li>
            <li><a href=<?php echo $logout_uri; ?>>Logout</a></li>
        </ul>
    </div>
    <div class="container">
        <h1>Calorie Overview</h1>
        
        <div class="dashboard">
            <div class="card">
                <h2><i class="fas fa-user"></i> Personal Profile</h2>
                
                <div class="info-row">
                    <span class="info-label">Weight</span>
                    <span class="info-value"><?php echo $weight;?> kg</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Height</span>
                    <span class="info-value"><?php echo $height;?> cm</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Sex</span>
                    <span class="info-value"><?php echo $gender;?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Age</span>
                    <span class="info-value"><?php echo $age?> years</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Activity Level</span>
                    <span class="info-value"><?php echo $activityLevelDisplay;?></span>
                </div>
                
                <div class="highlight-box">
                    <h3>BMI Status</h3>
                    <?php echo $bmi_message; ?>
                </div>
            </div>
            
            <div class="card">
                <h2><i class="fas fa-fire"></i> Calorie Metrics</h2>
                
                <div class="info-row">
                    <span class="info-label">Basal Metabolic Rate (BMR)</span>
                    <span class="info-value">
                        <?php echo $bmr; ?> kcal/day
                    </span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Maintenance Calories (TDEE)</span>
                    <span class="info-value">
                        <?php echo $tdee; ?> kcal/day
                    </span>
                </div>
                
                <?php if (is_numeric($bmr) && is_numeric($tdee)): ?>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
                <div class="bar-labels">
                    <span>BMR</span>
                    <span>Activity</span>
                </div>
                <?php endif; ?>
                
                <div class="highlight-box">
                    <h3>Weight Goals</h3>
                    <?php if (is_numeric($tdee)): ?>
                    <div class="info-row">
                        <span class="info-label">Weight Loss (-0.5kg/week)</span>
                        <span class="info-value"><?= htmlspecialchars(number_format($tdee - 500)) ?> kcal/day</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Weight Gain (+0.5kg/week)</span>
                        <span class="info-value"><?= htmlspecialchars(number_format($tdee + 500)) ?> kcal/day</span>
                    </div>
                    <?php else: ?>
                    <p>Weight goal calculations not available</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="button-container">
            <a href="<?php echo $dashboard_uri; ?>" class="back-button">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>
</body>
</html>