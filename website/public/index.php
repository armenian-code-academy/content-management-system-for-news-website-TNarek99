<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/25/16
 * Time: 8:34 PM
 */

define('NEWS_ROOT', '/var/www/html/News/');

$controller = 'home';
$action = 'index';

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
}

$controller = ucfirst($controller);
$controller .= 'Controller';

if (file_exists( NEWS_ROOT . '/admin/Controller/' . $controller . '.php' )) {
    require_once NEWS_ROOT . '/admin/Controller/' . $controller . '.php';

    if (class_exists($controller)) {
        $controllerObj = new $controller;
        $action .= 'Action';
        if (method_exists($controllerObj, $action)) {

        } else {
            require_once NEWS_ROOT . '/admin/Controller/ErrorController.php';
            $errorController = new ErrorController($action . ' method not found', 404);
            $errorController->errorAction();
            die;
        }

    } else {
        require_once NEWS_ROOT . '/admin/Controller/ErrorController.php';
        $errorController = new ErrorController($controller . ' class not found', 404);
        $errorController->errorAction();
        die;
    }

} else {
    require_once NEWS_ROOT . '/admin/Controller/ErrorController.php';
    $errorController = new ErrorController($controller . ' file not found', 404);
    $errorController->errorAction();
    die;
}

$controllerObj->$action();