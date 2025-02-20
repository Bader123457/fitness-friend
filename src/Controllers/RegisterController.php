<?php
require_once __DIR__ . "/../Models/user-class.php";

class RegisterController {
    public $appendUri = '';
    public function index() {
        // Generate all redirect links
        $home_uri = '\'' . $this->appendUri . '/home' . '\'';
        $validate_uri = '\'' . $this->appendUri . '/register/validate' . '\'';
        // Load the view for the second website
        require_once __DIR__ . '/../Views/register.php';
    }
    public function validate() {
        $register_uri = $this->appendUri . '/register';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            var_dump($_POST);
            $username = $_POST['uname'];
            $email = $_POST['email'];
            $password = $_POST['psw'];
            $confirm_password = $_POST['cnfm-psw'];
            
            $email = /*$_POST['email']*/ "a@b.c"; //please remove the "a@b.c" when the email feature has been fixed

            if($password != $confirm_password) {
                //confirm password not the same
            } else {
                //confirm password is the same
                $user = new User(user_id: null, username: $username, email: $email, password: $password);
                $user->saveToDB();
            }

            //session stuff
            
        } else {
            header('Location: '. $register_uri);
            die();
        }
    }
}