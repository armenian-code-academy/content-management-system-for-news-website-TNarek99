<?php

define('NEWS_ADMIN_ROOT', '/var/www/html/News/admin/');
define('NEWS_ADMIN_ROOT_URL', 'http://localhost/News/admin/public/index.php');

require NEWS_ADMIN_ROOT . '../core/classes/View.php';

$controller = 'home';
$action = 'index';

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
}

$controller = ucfirst($controller);
$controller .= 'Controller';

if (file_exists( NEWS_ADMIN_ROOT . '/Controller/' . $controller . '.php' )) {
    require_once NEWS_ADMIN_ROOT . '/Controller/' . $controller . '.php';

    if (class_exists($controller)) {
        $controllerObj = new $controller;
        $action .= 'Action';
        if (method_exists($controllerObj, $action)) {

        } else {
            require_once NEWS_ADMIN_ROOT . '/Controller/ErrorController.php';
            $errorController = new ErrorController($action . ' method not found', 404);
            $errorController->errorAction();
            die;
        }

    } else {
        require_once NEWS_ADMIN_ROOT . '/Controller/ErrorController.php';
        $errorController = new ErrorController($controller . ' class not found', 404);
        $errorController->errorAction();
        die;
    }

} else {
    require_once NEWS_ADMIN_ROOT . '/Controller/ErrorController.php';
    $errorController = new ErrorController($controller . ' file not found', 404);
    $errorController->errorAction();
    die;
}

$view = $controllerObj->$action();
$content = $view->getRenderedContent();

$layout = new View('Layout/Main');
$layout->assign('content', $content);
$layout->render();