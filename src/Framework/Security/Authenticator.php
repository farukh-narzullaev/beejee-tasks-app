<?php

namespace Framework\Security;

use Exception;

class Authenticator
{
    public static function auth($username, $password)
    {
        $modelFqn = "App\\Model\\" . AUTH_MODEL;

        if (!class_exists($modelFqn)) {
            // Auth model not found, but do not show such kind of errors to users.
            throw new Exception('Something went wrong, please try again later.');
        }

        if (!method_exists($modelFqn, 'findByUsername')) {
            // Auth model must define "findByUsername" static method.
            throw new Exception('Something went wrong, please try again later.');
        }

        if (false === $user = $modelFqn::findByUsername($username)) {
            throw new Exception('Incorrect username.');
        }

        if (false === password_verify($password, $user['password'])) {
            throw new Exception('Incorrect password.');
        }

        $_SESSION['user'] = $username;

        return true;
    }
}
