<?php

namespace Framework\Http;

/**
 * Class Request
 *
 * @package Framework\Http
 * @author  Farukh Narzullaev <faruh.narzullaev@sibers.com>
 */
class Request implements RequestInterface
{
    private $get;
    private $post;
    private $server;
    private $attributes;

    public function __construct(array $get = [], array $post = [], array $server = [])
    {
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
    }

    public static function createFromGlobals()
    {
        return new static($_GET, $_POST, $_SERVER);
    }

    public function getUri()
    {
        return $this->server['REQUEST_URI'];
    }

    public function getUriPath()
    {
        return explode('?', $this->server['REQUEST_URI'], 2)[0];
    }

    public function getMethod()
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function addAttribute($name, $value)
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getAttribute($name)
    {
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }

        return null;
    }

    public function getParam($name, $default = null)
    {
        if (array_key_exists($name, $this->get)) {
            return trim(strip_tags($this->get[$name]));
        }

        return $default;
    }

    public function postParam($name, $default = null)
    {
        if (array_key_exists($name, $this->post)) {
            return trim(strip_tags($this->post[$name]));
        }

        return $default;
    }

    public function all()
    {
        return $this->post;
    }
}
