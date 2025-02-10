<?php
// src path
define('SRC_PATH', __DIR__ . '/../src/');

$requestUri = substr($_SERVER['REQUEST_URI'], 1);

// Default controllers and actions for when they are undefined
$controller = 'Controllers/HomeController.php';
$action = 'index';

/* 
Read the URL to find the associated controller and action to be run
Syntax for the URL: [domain name]/[controller name]/[action (method) name]
E.g. localhost/home/index

The URL gets broken down into: 
$controller = Controllers/[controller name w/ first letter capitalised]Controller.php
E.g. Controllers/HomeController.php

$action = [action (method) name] E.g. index
*/
if (!empty($requestUri)) {
    $uriParts = explode('/', $requestUri);
    if (count($uriParts) >= 1) {
        $controller = 'Controllers/' . ucfirst($uriParts[0]) . 'Controller.php';
        if (count($uriParts) >= 2) {
            $action = $uriParts[1];
        }
    }
}

/*
Look for the controller class in src/Controllers and the action requested 
If found, create a new instance of the controller and call the function
Else, show 404
*/
$controllerPath = SRC_PATH . $controller;
if (file_exists($controllerPath)) {
    require_once $controllerPath;

    $controllerClass = basename($controller, '.php');

    if (class_exists($controllerClass)) {
        $controllerInstance = new $controllerClass();
        if (method_exists($controllerInstance, $action)) {
            $controllerInstance->$action();
        } else {
            header("HTTP/1.0 404 Not Found");
            echo '404 - Action not found';
        }
    } else {
        header("HTTP/1.0 404 Not Found");
        echo '404 - Controller class not found';
    }
} else {
    header("HTTP/1.0 404 Not Found");
    echo '404 - Controller file not found';
}