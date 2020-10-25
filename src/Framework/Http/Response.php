<?php

namespace Framework\Http;

class Response extends AbstractResponse
{
    public function send()
    {
        header("HTTP/1.1 {$this->httpCode} OK");
        echo $this->body;
    }
}
