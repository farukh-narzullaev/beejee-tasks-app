<?php

namespace Framework\Routing;

use Framework\Http\RequestInterface;

class Route
{
    private $name;
    private $pattern;
    private $handler;
    private $methods;
    private $requirements;

    public function __construct($name, $pattern, $handler, array $methods, array $requirements)
    {
        $this->name         = $name;
        $this->pattern      = $pattern;
        $this->handler      = $handler;
        $this->methods      = $methods;
        $this->requirements = $requirements;
    }

    public function match(RequestInterface $request)
    {
        if ($this->methods and !in_array($request->getMethod(), $this->methods, true)) {
            return null;
        }

        // /{(.*)}/
        // ~\{([^\}]+)\}~

        $pattern = preg_replace_callback('/{(.*)}/', function ($matches) {
            $argument = $matches[1];
            $replace  = $this->requirements[$argument] ?? '[^}]+';

            return "(?P<{$argument}>{$replace})";
        }, $this->pattern);

        if (preg_match('~^' . $pattern . '$~i', $request->getUriPath(), $matches)) {
            return new MatchedRoute(
                $this->name,
                $this->handler,
                array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY)
            );
        }

        return null;
    }

    public function getHandler()
    {
        return $this->handler;
    }
}
