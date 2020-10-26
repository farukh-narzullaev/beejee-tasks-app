<?php

namespace Framework\Routing;

class MatchedRoute
{
    private $name;
    private $handler;
    private $attributes;

    public function __construct($name, $handler, $attributes = [])
    {
        $this->name = $name;
        $this->handler = $handler;
        $this->attributes = $attributes;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getHandler()
    {
        return [new $this->handler[0], $this->handler[1]];
    }

    public function getAttributes()
    {
        return $this->attributes;
    }
}
