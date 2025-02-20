<?php
class LoginController {
    public $appendUri = '';
    public function index() {
        // Generate all redirect links
        $home_uri = '\'' . $this->appendUri . '/home' . '\'';
        $validate_uri = '\'' . $this->appendUri . '/login/validate' . '\'';
        // Load the view for the second website
        require_once __DIR__ . '/../Views/login.php';
    }
    public function validate() {
        $login_uri = $this->appendUri . '/login';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            var_dump($_POST);
            $username = $_POST['uname'];
            $password = $_POST['psw'];
            // Add validate function here
            // Add session here
        } else {
            header('Location: '. $login_uri);
            die();
        }
    }
}