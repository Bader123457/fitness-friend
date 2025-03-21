<?php
class CalorieController {
    public $appendUri = '';
    function index() {
        // Include classes
        require_once __DIR__ . '/../Models/user-class.php';
        require_once __DIR__ . '/../Models/physical-activity-class.php';

        // Get session
        session_set_cookie_params([
            'lifetime' => 86400, // 1 day
            'secure' => true,   // Only send over HTTPS
            'httponly' => true,  // Prevent JavaScript access
            'samesite' => 'Strict' // Prevent CSRF attacks
        ]);
        session_start();

        // Generate links 
        $dashboard_uri = $this->appendUri . '/dashboard';
        $logout_uri = '\''. $this->appendUri . '/login/logout'. '\'';
        $profile_uri = '\''. $this->appendUri . '/profile'. '\'';
        $food_uri = '\'' . $this->appendUri . '/foodtracker' . '\'';  
        $workout_uri = '\'' . $this->appendUri . '/workout' . '\'';  

        // Check user
        if (isset($_SESSION['user']) && $_SESSION['logged_in'] === true) {
            // Refresh user information
            $_SESSION['user'] = User::getUser(user_id: $_SESSION['user']->user_id);

            // Variables for front end
            try {
                $welcome_display = $_SESSION['user']->username;
            } catch (Exception $e) {
                $welcome_display = 'ERROR';
            }
            $weight = $_SESSION['user']->weight;
            $height = $_SESSION['user']->height;
            $gender = $_SESSION['user']->gender;
            $activityLevel = $_SESSION['user']->activity_level;
            
            $activityLevelDisplay = NULL;
            switch ($activityLevel) {
                case "SED":
                    $activityLevelDisplay = 'Sedentary';
                    break;
                case "LIGHT":
                    $activityLevelDisplay = 'Light Activity';
                    break;
                case "MEDIUM":
                    $activityLevelDisplay = 'Medium Activity';
                    break;
                case "HEAVY":
                    $activityLevelDisplay = 'Heavy Activity';
                    break;
                case "ATHL":
                    $activityLevelDisplay = 'Athlete';
                    break;
                default:
                    $activityLevelDisplay = 'Unknown';
            }

            // Age calculation
            $dob = date_create($_SESSION['user']->dob);
            $age = date_diff($dob, date_create(date("Y-m-d")))->y;

            // BMI calculation
            $bmi_message = '';
            if (is_numeric($weight) && is_numeric($height)) {
                $bmi = $weight / (($height/100) * ($height/100));
                $bmiRounded = round($bmi, 1);
                
                if ($bmi < 18.5) {
                    $bmi_message = "Your BMI is $bmiRounded - Underweight";
                } elseif ($bmi < 25) {
                    $bmi_message = "Your BMI is $bmiRounded - Normal weight";
                } elseif ($bmi < 30) {
                    $bmi_message = "Your BMI is $bmiRounded - Overweight";
                } else {
                    $bmi_message = "Your BMI is $bmiRounded - Obese";
                }
            } else {
                $bmi_message = "BMI calculation not available";
            }

            $activityLevels = [
                "SED" => 1.2,      
                "LIGHT" => 1.375,        
                "MEDIUM" => 1.55,        
                "HEAVY" => 1.725,
                "ATHL" => 1.9         
            ];
            
            // BMR Calculation
            if ($gender === "MALE") {
                $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
            } elseif ($gender === "FEMALE") {
                $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
            } else {
                $bmr = "Unknown (Invalid Gender)";
            }

            // TDEE Calculation
            if (isset($activityLevels[$activityLevel]) && gettype($bmr) !== 'string'){
                $tdee = round($bmr * $activityLevels[$activityLevel]);
            } else {
                $tdee = "Unknown";
            }

            // Progress bar calculation
            $progress_width = min(100, ($bmr !== "Unknown (Invalid Gender)" && $tdee !== "Unknown (Invalid Activity Level)") ? round(($bmr / $tdee) * 100) : 0);

            // Load the view
            require_once __DIR__ . '/../Views/calorie.php';
        } else {
            header('Location: '. $login_uri);
            die();   
        }
    }
}