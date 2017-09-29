<?php
error_reporting(E_ALL);
require_once __DIR__ . '/../protected/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
$parts = explode('/', $uri);

$controllerName = $parts[1] ?: 'Drivers';
$controllerName = '\\App\\Controllers\\' . $controllerName;
$actionName = @$parts[2] ?: 'default';


$controller = new $controllerName;

try {
    $controller->action($actionName);
}

catch (Throwable $e) {
    echo $e->getMessage();
}