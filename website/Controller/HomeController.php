<?php

/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/30/16
 * Time: 9:53 AM
 */
class HomeController
{

    public function indexAction()
    {
        $className = substr(__CLASS__, 0, strlen(__CLASS__) - 10);
        $actionName = substr(__METHOD__, strlen(__CLASS__) + 2);
        $actionName = substr($actionName, 0, strlen($actionName) - 6);

        require_once ROOT . 'View/' . $className . '/' . $actionName . '.php';
    }
}