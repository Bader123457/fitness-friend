<?php
class DBTestController {
    public $appendUri = '';
    public function index() {
        // Generate all redirect links
        //$second_uri = '\'' . $this->appendUri . '/second' . '\'';
        // Load the view for the first website
        require_once __DIR__ . '\..\Models\db-llf.php';

        echo DBConnection::create("
        INSERT INTO users 
        (user_id, username, email, first_name) 
        VALUES 
        (:user_id, :username, :email, :first_name)
        ", 
        [1, "stinker", "el@gmail.com", "first_name"],
        [":user_id", ":username", ":email", ":first_name"]);
    }
}