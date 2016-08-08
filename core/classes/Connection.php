<?php

require_once NEWS_ADMIN_ROOT . '../core/configs/db.config.php';

class Connection
{
    /**
     * @var PDO
     */
    private static $connection = NULL;

    /**
     * Connection constructor.
     */
    private function __construct()
    {

    }

    /**
     * @return PDO
     */
    public static function getConnection()
    {
        if (self::$connection == NULL){
            $conn = new PDO("mysql:host=" . HOST . ";dbname=" .  DATABASE, USER_NAME , PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection = $conn;
        }
        return self::$connection;
    }
}