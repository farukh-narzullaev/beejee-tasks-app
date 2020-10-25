<?php

namespace Framework\Http;

abstract class AbstractResponse implements ResponseInterface
{
    protected $body;
    protected $httpCode;

    public function __construct($body, $httpCode = 200)
    {
        $this->body = $body;
        $this->httpCode = $httpCode;
    }
}
