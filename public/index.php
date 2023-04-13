<?php

session_start();

$path = str_replace('\\', DIRECTORY_SEPARATOR, dirname(__DIR__) . '/Core/functions.php');
require $path;

spl_autoload_register(function($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require base_path('Core/' . $class . '.php');
});

require base_path('Core/router.php'); 
$router = new Router();

require base_path('routes.php');

$method = isset($_POST['_method']) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

$router->route($url,$method);