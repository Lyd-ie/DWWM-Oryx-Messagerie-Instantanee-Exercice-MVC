<?php

// Création/récupération $_SESSION pour stocker infos utilisateur
session_start();

// Autoload des classes
function loadClass($class)
{
    // Si la classe appelée contient le mot "Controller"
    if (str_contains($class, 'Controller')) {
        // elle sera recherchée dans le dossier "controllers"
        require 'controllers/' . $class . '.php';
    } else {
        // sinon dans le dossier "models"
        require 'models/' . $class . '.php';
    }
    
}
spl_autoload_register('loadClass');

// Explode de l'adresse afin de router le fonctionnement de l'app via $_GET
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
$params = explode('/', $_GET['action']);

// Si l'explode de $_GET ressort plus d'une valeur
if (isset($params[1])) {
    // la 1e valeur désignera le controlleur
    $controller = $params[0] . "Controller";
    // la 2e valeur sera la méthode
    $method = $params[1];

    // Une classe controleur est appelé. $param[0] sert à nommer le bon controleur
    // Ex : $param[0] = login. $controller = loginController. $Controller = new loginController();
    $Controller = new $controller();

    // Si la méthode existe dans la classe controleur appelée, celle-ci sera activée
    if (method_exists($Controller, $method) == TRUE) {
        // Ex : $param[0] = login. $param[1] = signup
        // Cela donne : new loginController()->signup();
        $Controller->$method();
    } else {
        // Si la méthode n'existe pas -> error 404
        http_response_code(404);
        echo "La page recherchée n'existe pas...";
    }
// Si l'explode de $_GET ne ressort qu'une ou pas de valeurs
} else {
    // Initie par défaut loginIndex afin d'afficher la page de Login
    $Controller = new loginController();
    $Controller->loginIndex();
}