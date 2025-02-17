<?php
class HomeController {
    public $appendUri = '';
    public function index() {
        // Generate all redirect links
        $login_uri = '\'' . $this->appendUri . '/login' . '\'';
        $register_uri = '\'' . $this->appendUri . '/register' . '\'';
        // Load the view for the first website
        require_once __DIR__ . '/../Views/home.php';
    }
}