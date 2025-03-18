<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user"])) {
    die("Error: User not logged in.");
}

$dashboard_uri = $_SERVER['DOCUMENT_ROOT'] . "/fitness-Bro/dashboard.php";

// Extract user data
$user = $_SESSION["user"];

$weight = $user->weight;
$height = $user->height;
$gender = ucfirst(strtolower($user->gender)); // Normalize case
$dob = new DateTime($user->dob);
$today = new DateTime();
$age = ($dob->format('Y') == "0000") ? "Unknown" : $today->diff($dob)->y;
$activityLevel = strtoupper($user->activity_level); // Ensure case consistency

// BMR Calculation
if ($age === "Unknown") {
    $bmr = "Unknown (Invalid DOB)";
} else {
    if ($gender === "Male") {
        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
    } elseif ($gender === "Female") {
        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
    } else {
        $bmr = "Unknown (Invalid Gender)";
    }
}

// Activity level multipliers for TDEE
$activityLevels = [
    "SEDENTARY" => 1.2,      
    "LIGHT" => 1.375,        
    "MEDIUM" => 1.55,        
    "HEAVY" => 1.725,        
    "ATHLETE" => 1.9         
];

// Calculate TDEE (Total Daily Energy Expenditure)
$tdee = isset($activityLevels[$activityLevel]) ? round($bmr * $activityLevels[$activityLevel]) : "Unknown (Invalid Activity Level)";

// Format activity level for display
$activityLevelDisplay = ucfirst(strtolower($activityLevel));
?>

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
            padding: 20px;
        }
        
        h1 {
            color: #f5c518;
            margin-bottom: 30px;
            text-align: center;
            font-size: 24px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .dashboard {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
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
            width: <?= min(100, ($bmr !== "Unknown (Invalid Gender)" && $tdee !== "Unknown (Invalid Activity Level)") ? round(($bmr / $tdee) * 100) : 0) ?>%;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Calorie Overview</h1>
        
        <div class="dashboard">
            <div class="card">
                <h2><i class="fas fa-user"></i> Personal Profile</h2>
                
                <div class="info-row">
                    <span class="info-label">Weight</span>
                    <span class="info-value"><?= htmlspecialchars($weight) ?> kg</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Height</span>
                    <span class="info-value"><?= htmlspecialchars($height) ?> cm</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Sex</span>
                    <span class="info-value"><?= htmlspecialchars($gender) ?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Age</span>
                    <span class="info-value"><?= htmlspecialchars($age) ?> years</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Activity Level</span>
                    <span class="info-value"><?= htmlspecialchars($activityLevelDisplay) ?></span>
                </div>
                
                <div class="highlight-box">
                    <h3>BMI Status</h3>
                    <?php
                    if (is_numeric($weight) && is_numeric($height)) {
                        $bmi = $weight / (($height/100) * ($height/100));
                        $bmiRounded = round($bmi, 1);
                        
                        if ($bmi < 18.5) {
                            echo "Your BMI is $bmiRounded - Underweight";
                        } elseif ($bmi < 25) {
                            echo "Your BMI is $bmiRounded - Normal weight";
                        } elseif ($bmi < 30) {
                            echo "Your BMI is $bmiRounded - Overweight";
                        } else {
                            echo "Your BMI is $bmiRounded - Obese";
                        }
                    } else {
                        echo "BMI calculation not available";
                    }
                    ?>
                </div>
            </div>
            
            <div class="card">
                <h2><i class="fas fa-fire"></i> Calorie Metrics</h2>
                
                <div class="info-row">
                    <span class="info-label">Basal Metabolic Rate (BMR)</span>
                    <span class="info-value">
                        <?= is_numeric($bmr) ? htmlspecialchars(number_format($bmr)) : htmlspecialchars($bmr) ?> kcal/day
                    </span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Maintenance Calories (TDEE)</span>
                    <span class="info-value">
                        <?= is_numeric($tdee) ? htmlspecialchars(number_format($tdee)) : htmlspecialchars($tdee) ?> kcal/day
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
            <a href="/fitness-Bro/dashboard.php" class="back-button">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>
</body>
</html>v