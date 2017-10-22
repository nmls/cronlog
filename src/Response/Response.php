<?php

namespace Cronlog\Response;

abstract class Response
{
    protected $http_status;
    protected $content;

    public function __construct(int $http_status = 200, string $content = "")
    {
        $this->http_status = $http_status;
        $this->content = $content;
    }

    public function render()
    {
        header("HTTP/1.1 " . $this->http_status);
        echo $this->content;
    }

    public function getHTTPStatus()
    {
        return $this->http_status;
    }

    public function getContent()
    {
        return $this->content;
    }
}