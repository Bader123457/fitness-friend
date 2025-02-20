<?php
class RegisterController {
    public $appendUri = '';
    public function index() {
        // Generate all redirect links
        $home_uri = '\'' . $this->appendUri . '/home' . '\'';
        $validate_uri = '\'' . $this->appendUri . '/login/validate' . '\'';
        // Load the view for the second website
        require_once __DIR__ . '/../Views/register.php';
    }
    public function validate() {
        $register_uri = $this->appendUri . '/register';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            var_dump($_POST);
            $username = $_POST['uname'];
            $password = $_POST['psw'];
            $confirm_password = $_POST['cnfm-psw'];
            // Add validate function here
            // Add session here
        } else {
            header('Location: '. $register_uri);
            die();
        }
    }
}