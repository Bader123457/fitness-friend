<?php

require_once __DIR__ . "/../Models/user-class.php";
class LoginController {
    public $appendUri = '';
    public function index() {
        // Generate all redirect links
        $home_uri = '\'' . $this->appendUri . '/home' . '\'';
        $validate_uri = '\'' . $this->appendUri . '/login/validate' . '\'';

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
        $login_uri = $this->appendUri . '/login';
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
                var_dump($user);
                if($user->validatePassword($password)) {
                    echo "<br>valid";
                    // Add session here
                    
                    // Redirect here
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
}