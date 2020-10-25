<?php

namespace App\Controller;

use Framework\Templating;
use Framework\Http\Response;
use Framework\Http\RedirectResponse;

abstract class AbstractController
{
    public function render($template, $parameters = [])
    {
        return new Response(
            Templating::render($template, $parameters)
        );
    }

    public function redirect($path = '/', $httpCode = 302)
    {
        return new RedirectResponse('', $httpCode, $path);
    }

    public function setFlash($name, $message)
    {
        $_SESSION[$name] = $message;
    }
}
