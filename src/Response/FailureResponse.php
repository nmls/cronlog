<?php

namespace Cronlog\Response;

class FailureResponse extends Response
{
    public function __construct()
    {
        parent::__construct(500, "fail");
    }
}