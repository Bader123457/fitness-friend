<?php
require_once __DIR__ . "/../Models/user-class.php";

class RegisterController {
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
        $validate_uri = '\'' . $this->appendUri . '/register/validate' . '\'';
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
                case "confirm_password_error":
                    $error_msg = "Your passwords does not match. Please try again.";
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
        require_once __DIR__ . '/../Views/register.php';
    }
    public function validate() {
        $register_uri = $this->appendUri . '/register';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $username = $_POST['uname'];
                $email = $_POST['email'];
                $password = $_POST['psw'];
                $confirm_password = $_POST['cnfm-psw'];
            } catch (Exception $e) {
                header('Location: '. $register_uri. '?error=form_error');
                die();
            }
            

            if ($password != $confirm_password) {
                //confirm password not the same
                header('Location: '. $register_uri. '?error=confirm_password_error');
                die();
            } else {
                //confirm password is the same
                try {
                    $user = new User(user_id: null, username: $username, email: $email, password: $password);
                    try {
                        $user->saveToDB();
                    } catch (Exception $e) {
                        header('Location: '. $register_uri. '?error=database_error');
                        die();
                    }
                } catch (Exception $e) {
                    header('Location: '. $register_uri. '?error='. $e->getMessage());
                }
                
            }

            //session stuff
            
        } else {
            header('Location: '. $register_uri);
            die();
        }
    }
}