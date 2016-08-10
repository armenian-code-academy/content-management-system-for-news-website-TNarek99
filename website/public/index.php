<?php

define('NEWS_WEBSITE_ROOT', '/var/www/html/News/website/');
define('NEWS_ADMIN_ROOT', '/var/www/html/News/admin/');

$controller = 'home';
$action = 'index';

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
}

$controller = ucfirst($controller);
$controller .= 'Controller';

if (file_exists( NEWS_WEBSITE_ROOT . 'Controller/' . $controller . '.php' )) {
    require_once NEWS_WEBSITE_ROOT . 'Controller/' . $controller . '.php';

    if (class_exists($controller)) {
        $controllerObj = new $controller;
        $action .= 'Action';
        if (method_exists($controllerObj, $action)) {

        } else {
            require_once NEWS_WEBSITE_ROOT . '../admin/Controller/ErrorController.php';
            $errorController = new ErrorController($action . ' method not found', 404);
            $errorController->errorAction();
            die;
        }

    } else {
        require_once NEWS_WEBSITE_ROOT . 'admin/Controller/ErrorController.php';
        $errorController = new ErrorController($controller . ' class not found', 404);
        $errorController->errorAction();
        die;
    }

} else {
    require_once NEWS_WEBSITE_ROOT . '../admin/Controller/ErrorController.php';
    $errorController = new ErrorController($controller . ' file not found', 404);
    $errorController->errorAction();
    die;
}

$view = $controllerObj->$action();
$view->render();