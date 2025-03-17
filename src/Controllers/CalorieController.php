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

        // Check user
        if (isset($_SESSION['user']) && $_SESSION['logged_in'] === true) {
            // Refresh user information
            $_SESSION['user'] = User::getUser(user_id: $_SESSION['user']->user_id);

            // Load the view for the first website
            require_once __DIR__ . '/../Views/calorie.php';
        } else {
            header('Location: '. $login_uri);
            die();   
        }
    }
}