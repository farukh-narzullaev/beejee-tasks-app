<?php

namespace Framework;

class Templating
{
    public static function render($name, $parameters = [])
    {
        $name = str_replace('.', '/', $name);

        ob_start();

        extract($parameters, EXTR_SKIP);

        include static::templatesDir() . '/' . $name . '.php';

        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

    private static function templatesDir()
    {
        return realpath(dirname(__DIR__) . '/../templates');
    }
}
