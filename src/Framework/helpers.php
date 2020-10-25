<?php

function flash($name) {
    $message = '';
    if (isFlash($name)) {
        $message = $_SESSION[$name];
        unset($_SESSION[$name]);
    }

    return $message;
}

function isFlash($name) {
    return array_key_exists($name, $_SESSION);
}

function user() {
    return (isset($_SESSION['user']))
        ? $_SESSION['user']
        : null;
}
