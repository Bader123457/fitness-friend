<?php

require_once __DIR__ . "/../Models/user-class.php";
class LoginController {
    public $appendUri = '';
    public function index() {
        // Get session
        session_set_cookie_params([
            'lifetime' => 86400, // 1 day
            'secure' => true,   // Only send over HTTPS
            'httponly' => true,  // Prevent JavaScript access
            'samesite' => 'Strict' // Prevent CSRF attacks
        ]);
        session_start();
        
        // Generate all redirect links
        $home_uri = '\'' . $this->appendUri . '/home' . '\'';
        $validate_uri = '\'' . $this->appendUri . '/login/validate' . '\'';
        $dashboard_uri = $this->appendUri . '/dashboard';

        // Check if login session already exists
        if (isset($_SESSION['user']) && $_SESSION['logged_in'] === true) {
            header('Location: '. $dashboard_uri);
            die();
        }

        // Check if error messages need to be displayed
        $error_display = False;
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['error'])) {
            $error_display = True;
            $error_type = $_GET['error'];
            $error_msg = "";
            // Display error message
            switch ($error_type) {
                case "credentials_error":
                    $error_msg = "Your credentials are incorrect. Please try again.";
                    break;
                case "database_error":
                    $error_msg = "Something went wrong with the login database. Please contact an administrator.";
                    break;
                case "form_error":
                    $error_msg = "Something went wrong with the login form. Please refresh your page or contact an administrator.";
                    break;
                default:
                    $error_msg = $error_type;
            }
        }

        // Load the view for the second website
        require_once __DIR__ . '/../Views/login.php';
    }
    public function validate() {
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
        $dashboard_uri = $this->appendUri . '/dashboard';

        // Check if login session already exists
        if (isset($_SESSION['user']) && $_SESSION['logged_in'] === true) {
            header('Location: '. $dashboard_uri);
            die();
        }

        // Handle validation
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $username = $_POST['uname'];
                $password = $_POST['psw'];
            } catch (Exception $e) {
                header('Location: '. $login_uri. '?error=form_error');
                die();
            }

            // Try to get user and password, then validate
            try{
                $user = User::getUser(username: $username);
                if($user->validatePassword($password)) {
                    $_SESSION['user'] = $user;
                    $_SESSION['logged_in'] = true;
                    // Regenerate session ID for security
                    session_regenerate_id(true);
                    // Redirect
                    header('Location: '. $dashboard_uri);
                } else {
                    header('Location: '. $login_uri. '?error=credentials_error');
                    die();
                }

            } catch (Exception $e) {
                header('Location: '. $login_uri. '?error=database_error');
                die();
            }
        } else {
            header('Location: '. $login_uri);
            die();
        }
    }
    public function logout() {
        $home_uri =  $this->appendUri . '/home';
        session_start();
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session
        setcookie(session_name(), '', time() - 3600, '/'); // Clear the session cookie
        header('Location: '. $home_uri);
    }
}