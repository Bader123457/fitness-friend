<?php
class WorkoutController {
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

        // Construct Links
        $login_uri = $this->appendUri . '/login';
        $search_compendium_uri = '\'' . $this->appendUri . '/workout/search_compendium' . '\'';
        $dashboard_uri = '\'' . $this->appendUri . '/dashboard' . '\'';
        $logout_uri = '\''. $this->appendUri . '/login/logout'. '\'';
        $calorie_uri = '\'' . $this->appendUri . '/calorie' . '\'';
        $food_uri = '\'' . $this->appendUri . '/foodtracker' . '\'';  
        $profile_uri = '\''. $this->appendUri . '/profile'. '\'';

        // Check User
        if (isset($_SESSION['user']) && $_SESSION['logged_in'] === true) {
            // Refresh user information
            $_SESSION['user'] = User::getUser(user_id: $_SESSION['user']->user_id);

            try {
                $welcome_display = $_SESSION['user']->username;
            } catch (Exception $e) {
                $welcome_display = 'ERROR';
            }

            require_once __DIR__ . '/../Views/workout.php';
        } else {
            header('Location: '. $login_uri);
            die();   
        }
    }

    public function search_compendium() {
        require_once __DIR__ . "/../Models/physical-activity-class.php";
        $login_uri = $this->appendUri . '/login';

        if (isset($_POST['activity_search'])) {
            $activitySearch = $_POST['activity_search'];
            $category = $_POST['category'];

            $result = search_physical_activities($category, $activitySearch);

            echo json_encode($result);
        } else {
            header('Location: '. $login_uri);
            die();   
        }
    }
}