<?php
// src path
define('SRC_PATH', __DIR__ . '/../src/');

$requestUri = substr($_SERVER['REQUEST_URI'], 1);
$httpHost = $_SERVER['HTTP_HOST'];

// Default controllers and actions for when they are undefined
// baseUri adds fixed parts of the URI to the front of any redirect links
// (if there are any, else keep it as empty string)
$controller = 'Controllers/HomeController.php';
$action = 'index';
$baseUri = '';

/* 
Read the URL to find the associated controller and action to be run
Syntax for the URL: [domain name]/[controller name]/[action (method) name]
E.g. localhost/home/index

The URL gets broken down into: 
$controller = Controllers/[controller name w/ first letter capitalised]Controller.php
E.g. Controllers/HomeController.php

$action = [action (method) name] E.g. index
==============================================================================================
SPECIAL CASE FOR HOSTING ON MANCHESTER UNIVERSITY HOSTING SERVICE

If the following code detects that the host is web.cs.manchester.ac.uk, then the first two
parts of the uri will be removed from uriParts and baseUri will be constructed

e.g. 
Before:
URI = /p14930yp/fitness_bro_test/home

After:
baseUri = /p14930yp/fitness_bro_test (the part that depends on who's hosting the website)
uriParts = array('home') (The actual requests)

This assumes that the repository is hosted on a subdirectory instead of being on the root of
whoever's hosting the website
*/
if (!empty($requestUri)) {
    $uriParts = explode('/', $requestUri);
    if ($httpHost == 'web.cs.manchester.ac.uk') {
        $baseUri = '/' . $uriParts[0] . '/' . $uriParts[1];
        array_splice($uriParts, 0, 2);
    }
    if (count($uriParts) >= 1) {
        if ($uriParts[0] != "") {
            $controller = 'Controllers/' . ucfirst($uriParts[0]) . 'Controller.php';
        }
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
        $controllerInstance->appendUri = $baseUri;
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