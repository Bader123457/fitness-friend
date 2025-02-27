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

        // Check user
        if (isset($_SESSION['user']) && $_SESSION['logged_in'] === true) {
            // Refresh user information
            $_SESSION['user'] = User::getUser(user_id: $_SESSION['user']->user_id);

            // Load the view for the first website
            require_once __DIR__ . '/../Views/dashboard.php';
        } else {
            header('Location: '. $login_uri);
            die();
        }
        
    }
}