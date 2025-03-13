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
        $change_personal_information_uri = '\'' . $this->appendUri . '/profile/change_personal_information' . '\'';
        $dashboard_uri = '\'' . $this->appendUri . '/dashboard' . '\'';

        /* 
        Error and Success message check and display 
        For both $enable_error_display and $enable_success_display:
        'n' = no message enabled
        'g' = generic message, appears at top of screen
        'u' = username change message, appears at Edit Username section
        'p' = password change message, appears at Edit Password section
        'i' = personal information change message, appears at Edit Personal Information section
        */
        $enable_error_display = "n";
        $enable_success_display = "n";
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Error check
            if (!empty($_GET['error'])) {
                $error_type = $_GET['error'];
                $error_msg = "";
                // Display error message
                switch ($error_type) {
                    // Username change errors
                    case "username_form_error":
                        $enable_error_display = "u";
                        $error_msg = "Something went wrong with the change username form. Please refresh your page or contact an administrator.";
                        break;
                    case "username_same_error":
                        $enable_error_display = "u";
                        $error_msg = "Your new username is the same as your old username. Please try again.";
                        break;
                    case "username_database_error":
                        $enable_error_display = "u";
                        $error_msg = 'Something went wrong with the database. Please contact an administrator.';
                        break;
                    // Password change errors
                    case "old_password_error":
                        $enable_error_display = "p";
                        $error_msg = "Your old password is incorrect. Please try again.";
                        break;
                    case "confirm_password_error":
                        $enable_error_display = "p";
                        $error_msg = "Your new passwords does not match. Please try again.";
                        break;
                    case "password_req_error":
                        $enable_error_display = "p";
                        $error_msg = 'Your new password does not match the requirements. Please try again.';
                        break;
                    case "password_same_error";
                        $enable_error_display = "p";
                        $error_msg = 'Your old and new password are the same. Please try again.';
                        break;
                    case "password_form_error":
                        $enable_error_display = "p";
                        $error_msg = "Something went wrong with the change password form. Please refresh your page or contact an administrator.";
                        break;
                    case "password_database_error":
                        $enable_error_display = "p";
                        $error_msg = 'Something went wrong with the database. Please contact an administrator.';
                        break;
                    // Personal Information change errors
                    case "personal_information_form_error":
                        $enable_error_display = "i";
                        $error_msg = "Something went wrong with the change personal information form. Please refresh your page or contact an administrator.";
                        break;
                    case "personal_information_req_error":
                        $enable_error_display = "i";
                        if (!empty($_GET['msg'])) {
                            $error_msg = $_GET['msg'];
                        } else {
                            $error_msg = "Some changes to your information didn't meet the requirements of the database, but we couldn't identify the error. Please contact an administrator.";
                        }
                        break;
                    case "personal_information_database_error":
                        $enable_error_display = "i";
                        $error_msg = 'Something went wrong with the database. Please contact an administrator.';
                        break;
                    // Unknown errors
                    default:
                        $enable_error_display = "g";
                        $error_msg = $error_type;
                } 
            } else if (!empty($_GET['success'])) {
                $success_type = $_GET['success'];
                $success_msg = "";
                switch ($success_type) {
                    case "username":
                        $enable_success_display = "u";
                        $success_msg = 'Your username has been successfully changed.';
                        break;
                    case "password":
                        $enable_success_display = "p";
                        $success_msg = 'Your password has been successfully changed.';
                        break;
                    case "personal_information":
                        $enable_success_display = "i";
                        if (!empty($_GET['warning']) && $_GET['warning'] == 'XLOSE') {
                            $enable_error_display = "i";
                            $error_msg = 'Please note that following plans recommended for Intensive Weight Loss may cause adverse health effects to certain people. Information on this website should not be treated as medical advice. Please consult your doctor regarding your use of Intensive Weight Loss plans.';
                        } else if (!empty($_GET['warning']) && $_GET['warning'] == 'XGAIN') {
                            $enable_error_display = "i";
                            $error_msg = 'Please note that following plans recommended for Intensive Weight Gain may cause adverse health effects to certain people. Information on this website should not be treated as medical advice. Please consult your doctor regarding your use of Intensive Weight Gain plans.';
                        }
                        $success_msg = 'Your personal information has been successfully changed.';
                        break;
                    // Unknown success
                    default:
                        $enable_success_display = "g";
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

    public function change_personal_information() {
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

            // Check POST
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                header('Location: '. $profile_uri);
                die();
            }

            // Get values
            try {
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $dob = $_POST['dob'];
                $gender = $_POST['gender'];
                $height = $_POST['height'];
                $weight = $_POST['weight'];
                $bfp = $_POST['bfp'];
                $activity = $_POST['activity'];
                $weight_preference = $_POST['weight_preference'];
            } catch (Exception $e) {
                header('Location: '. $profile_uri . '?error=personal_information_form_error');
                die();
            }
            
            // Check reqs
            try {
                $_SESSION['user']->first_name = $first_name;
                $_SESSION['user']->last_name = $last_name;
                if ($dob == '') {
                    $_SESSION['user']->dob = '0000-00-00';
                } else {
                    $_SESSION['user']->dob = $dob;
                }
                $_SESSION['user']->gender = $gender;
                $_SESSION['user']->height = (int)$height;
                $_SESSION['user']->weight = (int)$weight;
                $_SESSION['user']->body_fat_percent = (int)$bfp;
                $_SESSION['user']->activity_level = $activity;
                $_SESSION['user']->weight_preference = $weight_preference;
            } catch (Exception $e) {
                header('Location: '. $profile_uri. '?error=personal_information_req_error&msg=' . $e->getMessage());
                die();
            }

            // Save information
            try {
                $_SESSION['user']->saveToDB();
                if ($weight_preference == 'XLOSE' or $weight_preference == 'XGAIN'){
                    header('Location: '. $profile_uri . '?success=personal_information&warning=' . $weight_preference);
                    die();
                } else {
                    header('Location: '. $profile_uri . '?success=personal_information');
                    die();
                }
                
            } catch (Exception $e) {
                header('Location: '. $profile_uri . '?error=personal_information_database_error');
                die();
            }
        } else {
            header('Location: '. $login_uri);
            die();
        }
    }
}