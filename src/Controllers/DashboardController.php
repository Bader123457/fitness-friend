<?php
class DashboardController {
    public $appendUri = '';
    public function index() {
        // Include class
        require_once __DIR__ . '/../Models/user-class.php';

        // Get session
        session_set_cookie_params([
            'lifetime' => 86400, // 1 day
            'secure' => true,   // Only send over HTTPS
            'httponly' => true,  // Prevent JavaScript access
            'samesite' => 'Strict' // Prevent CSRF attacks
        ]);
        session_start();

        // Generate all redirect links
        $login_uri = $this->appendUri . '/login';
        $logout_uri = '\''. $this->appendUri . '/login/logout'. '\'';
        $profile_uri = '\''. $this->appendUri . '/profile'. '\'';
        $calorie_uri = '\''. $this->appendUri . '/calorie'. '\'';
        $food_uri = '\'' . $this->appendUri . '/foodtracker' . '\'';
        $workout_uri = '\'' . $this->appendUri . '/workout' . '\'';

        // Check user
        if (isset($_SESSION['user']) && $_SESSION['logged_in'] === true) {
            // Refresh user information
            $_SESSION['user'] = User::getUser(user_id: $_SESSION['user']->user_id);

            // Attempt to read from user information then prep variables to be displayed
            $error_msg_display = False;
            $error_msg = '';
            try {
                $welcome_display = $_SESSION['user']->username;
                $full_name = $_SESSION['user']->first_name . ' ' . $_SESSION['user']->last_name;
                $email = $_SESSION['user']->email;
                $dob = date_create($_SESSION['user']->dob);
                $age = date_diff($dob, date_create(date("Y-m-d")))->y;
                $gender_list = [
                    "MALE" => 'Male',
                    "FEMALE" => 'Female', 
                    "OTHER" => 'Others', 
                    "PNTS" => "Prefer Not To Say"
                ];
                $gender_display = $gender_list[$_SESSION['user']->gender];
                $height = $_SESSION['user']->height;
                $weight = $_SESSION['user']->weight;
            } catch (Exception $e) {
                $error_msg_display = True;
                $error_msg = 'Error: Cannot fetch user data from database. Connection between server and database may be severed. Contact an administrator.';
                $welcome_display = 'ERROR';
            }

            // Load the view for the first website
            require_once __DIR__ . '/../Views/dashboard.php';
        } else {
            header('Location: '. $login_uri);
            die();
        }
        
    }
}