<?php
session_start();
function loadClass($class)
{
    if (str_contains($class, 'Controller')) {
        require 'controllers/' . $class . '.php';
    } else {
        require 'models/' . $class . '.php';
    }
    
}
spl_autoload_register('loadClass');

define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

$params = explode('/', $_GET['action']);

if (isset($params[1])) {
    $controller = $params[0] . "Controller";
    $method = $params[1];

    $Controller = new $controller();

    if (method_exists($Controller, $method) == TRUE) {
        $Controller->$method();
    } else {
        http_response_code(404);
        echo "La page recherchée n'existe pas...";
    }
} else {
    $Controller = new LoginController();
    $Controller->loginIndex();
}