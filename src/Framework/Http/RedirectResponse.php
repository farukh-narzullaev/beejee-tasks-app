<?php

namespace Framework\Http;

class RedirectResponse extends AbstractResponse
{
    private $url;

    public function __construct($body, $httpCode, $url)
    {
        parent::__construct($body, $httpCode);

        $this->url = $url;
    }

    public function send()
    {
        header('Location: ' . $this->url, true, $this->httpCode);
    }
}
