<?php

namespace Framework;

use PDO;

class Database
{
    /**
     * @var PDO
     */
    protected static $connection;

    public function __construct()
    {
        $dsn = 'mysql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME;

        static::$connection = new PDO($dsn, DATABASE_USER, DATABASE_PASSWORD);

        static::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function connect()
    {
        return (null !== static::$connection)
            ? static::$connection
            : new static;
    }
}
