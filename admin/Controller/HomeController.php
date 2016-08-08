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
        $view = new View('Home/index');

        return $view;
    }
}