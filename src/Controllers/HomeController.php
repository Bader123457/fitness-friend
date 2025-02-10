<?php
class HomeController {
    public function index() {
        // Load the view for the first website
        require_once __DIR__ . '/../Views/home.php';
    }
}