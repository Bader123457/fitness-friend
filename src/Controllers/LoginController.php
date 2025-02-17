<?php
class LoginController {
    public $appendUri = '';
    public function index() {
        // Generate all redirect links
        $home_uri = '\'' . $this->appendUri . '/home' . '\'';
        // Load the view for the second website
        require_once __DIR__ . '/../Views/login.php';
    }
}