<?php
class ProfileController {
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
        $change_password_uri = '\'' . $this->appendUri . '/profile/change_password' . '\'';
        $change_username_uri = '\'' . $this->appendUri . '/profile/change_username' . '\'';
        $dashboard_uri = '\'' . $this->appendUri . '/dashboard' . '\'';

        // Error and Success message check and display
        $generic_error_display = False;
        $generic_success_display = False;
        $username_error_display = False;
        $username_success_display = False;
        $password_error_display = False;
        $password_success_display = False;
        $personal_error_display = False;
        $personal_success_display = False;
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Error check
            if (!empty($_GET['error'])) {
                $error_type = $_GET['error'];
                $error_msg = "";
                // Display error message
                switch ($error_type) {
                    // Password change errors
                    case "old_password_error":
                        $password_error_display = True;
                        $error_msg = "Your old password is incorrect. Please try again.";
                        break;
                    case "confirm_password_error":
                        $password_error_display = True;
                        $error_msg = "Your new passwords does not match. Please try again.";
                        break;
                    case "password_req_error":
                        $password_error_display = True;
                        $error_msg = 'Your new password does not match the requirements. Please try again.';
                        break;
                    case "password_same_error";
                        $password_error_display = True;
                        $error_msg = 'Your old and new password are the same. Please try again.';
                        break;
                    case "password_form_error":
                        $password_error_display = True;
                        $error_msg = "Something went wrong with the change password form. Please refresh your page or contact an administrator.";
                        break;
                    case "password_database_error":
                        $password_error_display = true;
                        $error_msg = 'Something went wrong with the database. Please contact an administrator.';
                        break;
                    // Unknown errors
                    default:
                        $generic_error_display = True;
                        $error_msg = $error_type;
                } 
            } else if (!empty($_GET['success'])) {
                $success_type = $_GET['success'];
                $success_msg = "";
                switch ($success_type) {
                    case "password":
                        $password_success_display = True;
                        $success_msg = 'Your password has been successfully changed.';
                        break;
                    // Unknown success
                    default:
                        $generic_success_display = True;
                        $success_msg = $success_type;
                }
            }
        }

        // Load the view for the first website
        if (isset($_SESSION['user']) && $_SESSION['logged_in'] === true) {
            // Refresh user information
            $_SESSION['user'] = User::getUser(user_id: $_SESSION['user']->user_id);

            // Load the view for the first website
            require_once __DIR__ . '/../Views/profile.php';
        } else {
            header('Location: '. $login_uri);
            die();
        }
    }

    public function change_username(){
        require_once __DIR__ . '/../Models/user-class.php';

        // Get session
        session_set_cookie_params([
            'lifetime' => 86400, // 1 day
            'secure' => true,   // Only send over HTTPS
            'httponly' => true,  // Prevent JavaScript access
            'samesite' => 'Strict' // Prevent CSRF attacks
        ]);
        session_start();

        // Construct links
        $profile_uri = $this->appendUri . '/profile';
        $login_uri = $this->appendUri . '/login';

        if (isset($_SESSION['user']) && $_SESSION['logged_in'] === true) {
            // Refresh user information
            $_SESSION['user'] = User::getUser(user_id: $_SESSION['user']->user_id);

            // Check POST
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                header('Location: '. $profile_uri);
                die();
            }

            // Get values
            try {
                $new_username = $_POST['new_uname'];
            } catch (Exception $e) {
                header('Location: '. $profile_uri . '?error=username_form_error');
                die();
            }
            
            // Check if username is same
            if ($_SESSION['user']->username == $new_username) {
                header('Location: '. $profile_uri . '?error=username_same_error');
                die();
            }

            // Attempt to save new username
            try {
                $_SESSION['user']->username = $new_username;
                $_SESSION['user']->saveToDB();
                header('Location: '. $profile_uri . '?success=username');
                die();
            } catch (Exception $e) {
                header('Location: '. $profile_uri . '?error=username_database_error');
                die();
            }


        } else {
            header('Location: '. $login_uri);
            die();
        }
    }

    public function change_password() {
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
        
        // Construct links
        $profile_uri = $this->appendUri . '/profile';
        $login_uri = $this->appendUri . '/login';

        if (isset($_SESSION['user']) && $_SESSION['logged_in'] === true) {
            // Refresh user information
            $_SESSION['user'] = User::getUser(user_id: $_SESSION['user']->user_id);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Get values
                try {
                    $old_psw = $_POST['old_psw'];
                    $new_psw = $_POST['new_psw'];
                    $conf_psw = $_POST['conf_psw'];

                } catch (Exception $e) {
                    header('Location: '. $profile_uri . '?error=password_form_error');
                    die();
                }

                // Validate old password
                if ($_SESSION['user']->validatePassword($old_psw)) {
                    // Compare New Password and Confirm Password
                    if ($new_psw === $conf_psw) {
                        // Compare New and Old Password
                        if ($new_psw === $old_psw) {
                            header('Location: '. $profile_uri . '?error=password_same_error');
                            die();
                        }

                        // Check password req
                        try {
                            $_SESSION['user']->password = $new_psw;
                            // Attempt to save password
                            try{
                                $_SESSION['user']->saveToDB();
                                header('Location: '. $profile_uri . '?success=password');
                            } catch (Exception $e){
                                header('Location: '. $profile_uri . '?error=password_database_error');
                                die();
                            }
                        } catch (Exception $e) {
                            header('Location: '. $profile_uri . '?error=password_req_error');
                            die();
                        }
                    } else {
                        header('Location: '. $profile_uri . '?error=confirm_password_error');
                        die();
                    }
                } else {
                    header('Location: '. $profile_uri . '?error=old_password_error');
                    die();
                }
            } else {
                header('Location: '. $profile_uri);
                die();
            }
        } else {
            header('Location: '. $login_uri);
            die();
        }
    }
}