<?php
class TestController {
    public $appendUri = '';
    public function index() {
        // Load the view for the first website
        require_once __DIR__ . '/../Models/physical-activity-class.php';
        echo "<pre>";
        print_r(search_physical_activities("Bicycling", "Mo"));
        echo "</pre>";
    }
}