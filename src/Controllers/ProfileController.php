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
        $dashboard_uri = '\'' . $this->appendUri . '/dashboard' . '\'';

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

        if (isset($_SESSION['user']) && $_SESSION['logged_in'] === true) {
            // Refresh user information
            $_SESSION['user'] = User::getUser(user_id: $_SESSION['user']->user_id);

            // Get values
            try {
                $old_psw = $_POST['old_psw'];
                $new_psw = $_POST['new_psw'];
                $conf_psw = $_POST['conf_psw'];

            } catch (Exception $e) {
                header('Location: '. $profile_uri . '?error=password_form_error');
                die();
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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