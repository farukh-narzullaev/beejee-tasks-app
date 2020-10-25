<?php

namespace App\Model;

use PDO;
use Framework\Database;

class User extends Database
{
    public static function findByUsername($username)
    {
        $stmt = static::$connection
            ->prepare("SELECT id, username, password FROM users WHERE username = :username");

        $stmt->bindValue(':username', $username, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
