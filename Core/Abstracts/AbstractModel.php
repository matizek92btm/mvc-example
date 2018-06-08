<?php

namespace Core\Abstracts;

use App\Config;

/**
 * Abstract Model
 *
 * @package Abstracts
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */
class AbstractModel
{
    /**
     * Return database connection
     *
     * @return mixed
     */
    public static function getDatabaseConnection()
    {
        static $database = null;

        if ($database === null) {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            $database = new \PDO($dsn, Config::DB_USER, Config::DB_PASSWD);
        }

        return $database;
    }
}
