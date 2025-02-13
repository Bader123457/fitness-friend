<?php
class HomeController {
    public $appendUri = '';
    public function index() {
        // Generate all redirect links
        $second_uri = '\'' . $this->appendUri . '/second' . '\'';
        // Load the view for the first website
        require_once __DIR__ . '/../Views/home.php';
    }
}